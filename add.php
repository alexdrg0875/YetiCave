<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 30.03.2019
 * Time: 15:30
 */
require_once ('init.php');
require_once ('functions.php');

session_start();

if (isset($_SESSION['user_name'])){
  $is_auth = $_SESSION['is_auth'];
  $user_id = $_SESSION['user_id'];
  $user_email = $_SESSION['user_email'];
  $user_name = $_SESSION['user_name'];
  $user_avatar = $_SESSION['user_avatar'];
}

// запрос списка категорий
if($connect_sql == false) {
  print('Ошибка подключения:' . mysqli_connect_error());
} else {
  $query_result = mysqli_query($connect_sql, 'SELECT id, name, ename FROM categories ORDER BY id');
  if (!$query_result){
    print('Ошибка MYSQL:' . mysqli_error());
  } else {
    $categories = mysqli_fetch_all($query_result, MYSQLI_ASSOC);
  }
}

// закрытие страницы для анонимных пользовотелей
if ($is_auth) {
  // Выполняется при отправке формы с последующей валидацией
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $required_fields = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date'];
    $errors = [];

    $lot_name = $_POST['lot-name'] ?? '';
    $category = $_POST['category'] ?? 'Выберите категорию';
    $message = $_POST['message'] ?? '';
    $lot_rate = $_POST['lot-rate'] ?? '';
    $lot_step = $_POST['lot-step'] ?? '';
    $file_url = $_POST['file'] ?? 'img/lot.jpg'; // если отсутствует загруженное изображение лота, то подставляется заглушка
    $lot_end_date = $_POST['lot-date'] ?? '';

    // проверка полей на пустоту
    foreach ($required_fields as $field) {
      if (empty($_POST[$field])) {
        $errors[$field] = 'form__item--invalid';
        $form_error = 'form--invalid';
      }
    }

    // проверка полей на соответствие
    if ($category == 'Выберите категорию') {
      $errors['category'] = 'form__item--invalid';
      $form_error = 'form--invalid';
    }
    if (!is_numeric($lot_rate)) {
      $errors['lot-rate'] = 'form__item--invalid';
      $form_error = 'form--invalid';
    }
    if (!is_numeric($lot_step)) {
      $errors['lot-step'] = 'form__item--invalid';
      $form_error = 'form--invalid';
    }

    // проверка загруженного изображеня лота
    if (!empty($_FILES['file']['name'])) {
      $file_name = $_FILES['file']['name'];
      $file_path = __DIR__ . '/img/';
      $file_url = 'img/' . $file_name;
      move_uploaded_file($_FILES['file']['tmp_name'], $file_path . $file_name);
    }

    //поиск id categories согласно имени в $_POST для добавления в базу
    foreach ($categories as $key) {
      if ($key['name'] == $category) {
        $category_id = $key['id'];
      }
    }

    // Выполняется если нет ошибок
    if (empty($errors)) {

      //добавление лота в базу
      if(!$connect_sql) {
        print('Ошибка подключения:' . mysqli_connect_error());
      } else {
        $stmt = mysqli_prepare($connect_sql, "INSERT INTO lots (category_id, user_id, dt_add, dt_end, price, bet_step, title, description, path) VALUES (?,?,?,?,?,?,?,?,?)");
        if (mysqli_stmt_bind_param($stmt,'iissiisss',$category_id,$user_id, date('Y-m-d H:i:s'), $lot_end_date, $lot_rate, $lot_step, $lot_name, $message, $file_url)) {
          mysqli_stmt_execute($stmt);
          //printf("%d строк вставлено.\n", mysqli_stmt_affected_rows($stmt));
          //printf("Error: %s\n", mysqli_error($connect_sql));
          $new_item_id = mysqli_insert_id($connect_sql); // сохраняем id вновь добавленной записи для последующего перехода
          mysqli_stmt_close($stmt);
          mysqli_close($connect_sql);
        } else {
          print('Error run mysqli_stmt_bind_param: '.mysqli_error($connect_sql));
          header('Location: add.php');
        }
      }
// отображение вновь добавленнго лота на странице
      header('Location: lot.php?id='.$new_item_id);
/* Поменял подход на выше из-за бага метода(при перезагрузке страницы лот опять добавлвялся)
      $page_content = renderTemplate('templates/lot.php', [
        'lot_name' => $lot_name,
        'lot_image' => $file_url,
        'lot_alt' => 'Изображение лота',
        'lot_category' => $category,
        'lot_price' => $lot_rate,
        'lot_description' => $message
      ]);

      $layout_content = renderTemplate('templates/layout.php', [
        'content' => $page_content,
        'categories' => $categories,
        'is_auth' => $is_auth,
        'user_name' => $user_name,
        'user_avatar' => $user_avatar,
        'title' => $lot_name,
        'main_class' => ''
      ]);

      print($layout_content);

*/
    }
    // Выполняется для исправления ошибок в форме
    if (!empty($errors)) {
      $page_content = renderTemplate('templates/add.php', [
        'categories' => $categories,
        'form_error' => $form_error,
        'name_error' => $errors['lot-name'],
        'category_error' => $errors['category'],
        'message_error' => $errors['message'],
        'rate_error' => $errors['lot-rate'],
        'step_error' => $errors['lot-step'],
        'date_error' => $errors['lot-date'],
        'file_error' => $errors['file'],
        'lot_name' => $lot_name,
        'category' => $category,
        'message' => $message,
        'lot_rate' => $lot_rate,
        'lot_step' => $lot_step,
        'file_url' => $file_url,
        'lot_date' => $lot_end_date,
      ]);

      $layout_content = renderTemplate('templates/layout.php', [
        'content' => $page_content,
        'categories' => $categories,
        'is_auth' => $is_auth,
        'user_name' => $user_name,
        'user_avatar' => $user_avatar,
        'title' => 'Добавление лота',
        'main_class' => ''
      ]);

      print($layout_content);
    }

  } else {

    // Выполняется при первой загрузке страницы
    $page_content = renderTemplate('templates/add.php',[
      'categories' => $categories
    ]);

    $layout_content = renderTemplate('templates/layout.php', [
      'content' => $page_content,
      'categories' => $categories,
      'is_auth' => $is_auth,
      'user_name' => $user_name,
      'user_avatar' => $user_avatar,
      'title' => 'Добавление лота',
      'main_class' => ''
    ]);

    print($layout_content);
  }

} else {
  http_response_code(403);
}
?>