<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 08.04.2019
 * Time: 17:18
 */

require_once ('data.php');
require_once ('functions.php');

session_start();


// Выполняется при отправке формы с последующей валидацией
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $required_fields = ['email', 'password', 'name', 'message'];
  $errors = [];
  $text_error = [];

  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';
  $name = $_POST['name'] ?? '';
  $message = $_POST['message'] ?? '';
  $user_avatar = $_POST['photo2'] ?? 'img/user.jpg';

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
// проверка введенного email на возможность существования в базе
  if (empty($errors)) {
    $con = mysqli_connect('localhost', 'root', '', 'yeticave');
    if($con == false) {
      print('Ошибка подключения:' . mesqli_connect_error());
    } else {
      $query_result = mysqli_query($con, 'SELECT email FROM users');
      if (!$query_result){
        print('Ошибка MYSQL:' . mesqli_error());
      } else {
        $users = mysqli_fetch_all($query_result, MYSQLI_ASSOC);
        foreach ($users as $user_id) {
          if ($user_id['email'] == $email) {
            $errors['email'] = 'form__item--invalid';
            $text_error['email'] = 'Пользователь с данным e-mail уже зарегестрирован';
            $form_error = 'form--invalid';
            break;
          }
        }
      }
    }
  }

// Выполняется для исправления ошибок в форме
  if (!empty($errors)) {
    $page_content = renderTemplate('templates/sign-up.php', [
      'form_error' => $form_error,
      'email_error' => $errors['email'],
      'description_email_err' => $text_error['email'],
      'pass_error' => $errors['password'],
      'description_pass_err' => $text_error['password'],
      'name_error' => $errors['name'],
      'contact_error' => $errors['message'],
      'email' => $email,
      'name' => $name,
      'message' => $message,
    ]);

    $layout_content = renderTemplate('templates/layout.php', [
      'content' => $page_content,
      'categories' => $categories,
      'is_auth' => $is_auth,
      'user_name' => $user_name,
      'user_avatar' => $user_avatar,
      'title' => 'Регистрация',
      'main_class' => ''
    ]);

    print($layout_content);
  }

// после прохождения всех проверок регистрируем нового пользователя в базе
  if (empty($errors)) {
    $con = mysqli_connect('localhost', 'root', '', 'yeticave');
    if($con == false) {
      print('Ошибка подключения:' . mesqli_connect_error());
    } else {
      $stmt = mysqli_prepare($con, "INSERT INTO users (dt_add, email, name, password, avatar_path) VALUES (?,?,?,?,?)");
      mysqli_stmt_bind_param($stmt,'sssss',date('Y-m-d H:i:s'),$email, $name, password_hash($password, PASSWORD_DEFAULT), $user_avatar);
      if (!$query_result){
        print('Ошибка MYSQL:' . mesqli_error());
      } else {
        mysqli_stmt_execute($stmt);
        $_SESSION = [];
        header('Location: login.php');
      }
    }
  }

} else {

// Выполняется при первой загрузке страницы

  $page_content = renderTemplate('templates/sign-up.php');

  $layout_content = renderTemplate('templates/layout.php', [
    'content' => $page_content,
    'categories' => $categories,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'user_avatar' => $user_avatar,
    'title' => 'Регистрация',
    'main_class' => ''
  ]);

  print($layout_content);
}

?>