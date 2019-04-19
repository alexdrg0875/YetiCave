<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 02.04.2019
 * Time: 23:45
 */
require_once ('data.php');
require_once ('functions.php');

session_start();


// Выполняется при отправке формы с последующей валидацией
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $required_fields = ['email', 'password'];
  $errors = [];
  $text_error = [];

  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';

// проверка полей на пустоту и введенного e-mail
  foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
      $errors[$field] = 'form__item--invalid';
      $text_error[$field] = 'Поле должно быть заполнено';
      $form_error = 'form--invalid';
    } elseif ($field == 'email') {
      if (!filter_var($_POST[$field], FILTER_VALIDATE_EMAIL)) {
        $errors[$field] = 'form__item--invalid';
        $text_error[$field] = 'Введите корректный e-mail';
      }
    }
  }

// поиск e-mail в базе и проверка пароля
  if (empty($errors)) {
    $con = mysqli_connect('localhost', 'root', '', 'yeticave');
    if($con == false) {
      print('Ошибка подключения:' . mesqli_connect_error());
    } else {
      $query_result = mysqli_query($con, 'SELECT id, email, name, password, avatar_path FROM users');
      if (!$query_result){
        print('Ошибка MYSQL:' . mesqli_error());
      } else {
        $users = mysqli_fetch_all($query_result, MYSQLI_ASSOC);
        foreach ($users as $key) {
          if ($key['email'] == $email) {
            if (password_verify($password, $key['password'])) {
              $errors = [];
              $text_error = [];
              $is_auth = true;
              $user_id = $key['id'];
              $user_email = $key['email'];
              $user_name = $key['name'];
              $user_avatar = $key['avatar_path'];
              setcookie('user_email', $key['email'], strtotime('+1 year'), '/');
              $_SESSION['is_auth'] = $is_auth;
              $_SESSION['user_id'] =  $user_id;
              $_SESSION['user_email'] =  $user_email;
              $_SESSION['user_name'] = $user_name;
              $_SESSION['user_avatar'] = $user_avatar;
              break;
            } else {
              $errors['password'] = 'form__item--invalid';
              $text_error['password'] = 'Вы ввели неверный пароль';
              break;
            }
          } else {
            $errors['email'] = 'form__item--invalid';
            $text_error['email'] = 'Пользователь с таким логином не найден';
          }
        }
      }
    }
  }

// Выполняется если пользователь прошел аутенфикацию
  if (empty($errors)) {

    $page_content = renderTemplate('templates/index.php', [
      'lots' => $lots
    ]);

    $layout_content = renderTemplate('templates/layout.php', [
      'content' => $page_content,
      'categories' => $categories,
      'is_auth' => $is_auth,
      'user_name' => $user_name,
      'user_avatar' => $user_avatar,
      'title' => 'Главная',
      'main_class' => 'container'
    ]);

    print($layout_content);

  }

// Выполняется для исправления ошибок в форме
  if (!empty($errors)) {
    $page_content = renderTemplate('templates/login.php', [
      'form_error' => $form_error,
      'email_error' => $errors['email'],
      'description_email_err' => $text_error['email'],
      'pass_error' => $errors['password'],
      'description_pass_err' => $text_error['password'],
      'email' => $email,
    ]);

    $layout_content = renderTemplate('templates/layout.php', [
      'content' => $page_content,
      'categories' => $categories,
      'is_auth' => $is_auth,
      'user_name' => $user_name,
      'user_avatar' => $user_avatar,
      'title' => 'Вход',
      'main_class' => ''
    ]);

    print($layout_content);
  }

} else {

// Выполняется при первой загрузке страницы
  // проверяем наличие сохраненной сессии для восстановления работы при возврате на сайт без выхода
  if (isset($_SESSION['user_name'])){
    $is_auth = $_SESSION['is_auth'];
    $user_id = $_SESSION['user_id'];
    $user_email = $_SESSION['user_email'];
    $user_name = $_SESSION['user_name'];
    $user_avatar = $_SESSION['user_avatar'];
    header('Location: index.php');
  } elseif (isset($_COOKIE['user_email'])){ // проверяем наличие куки с данными пользователя для ускорения входа
    $email = $_COOKIE['user_email'];
  } else {
    $email = '';
  }

  $page_content = renderTemplate('templates/login.php', [
    'email' => $email
  ]);

  $layout_content = renderTemplate('templates/layout.php', [
    'content' => $page_content,
    'categories' => $categories,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'user_avatar' => $user_avatar,
    'title' => 'Вход',
    'main_class' => ''
  ]);

  print($layout_content);
}

?>