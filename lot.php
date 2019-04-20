<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 29.03.2019
 * Time: 21:39
 */

require_once ('init.php');
require_once ('functions.php');

session_start();

// запрос списка категорий
if($connect_sql == false) {
  print('Ошибка подключения:' . mysqli_connect_error());
} else {
  $query_result = mysqli_query($connect_sql, "SELECT id, category FROM categories ORDER BY id");
  if (!$query_result){
    print('Ошибка MYSQL:' . mysqli_error());
  } else {
    $categories = mysqli_fetch_all($query_result, MYSQLI_ASSOC);
  }
}

// запрос лота по пораметру _GET[id]
if($connect_sql == false) {
  print('Ошибка подключения:' . mysqli_connect_error());
} else {
  $query_result = mysqli_query($connect_sql, "SELECT l.id, l.title AS name, c.category, l.price, l.path AS image_path, l.alt_title AS alt, l.description FROM lots AS l JOIN categories AS c ON l.category_id = c.id WHERE l.id = $_GET[id]");
  if (!$query_result){
    print('Ошибка MYSQL:' . mysqli_error());
  } else {
    $lots = mysqli_fetch_all($query_result, MYSQLI_ASSOC);
  }
}

if (isset($_SESSION['user_name'])){
  $is_auth = $_SESSION['is_auth'];
  $user_id = $_SESSION['user_id'];
  $user_email = $_SESSION['user_email'];
  $user_name = $_SESSION['user_name'];
  $user_avatar = $_SESSION['user_avatar'];
}

// проверяем наличие куки с lotsviewed для сбора инфо для history page
if (isset($_COOKIE['lotsviewed_' . $user_name . $user_id])){
    $lots_viewed = json_decode($_COOKIE['lotsviewed_' . $user_name . $user_id]);
} else {
    $lots_viewed = [];
}


if (!empty($lots)) {
// проверяем просмотренный лот в массиве просмотренных, если нет, то добавляем в массив просмотренных
  if(!empty($lots_viewed)) {
    foreach ($lots_viewed as $viewed) {
      if ($lots[0]['id'] == $viewed) {
        $new_item = false;
        break;
      } else {
        $new_item = true;
      }
    }
  } else {
    $new_item = true;
  }

  if ($new_item) {
    $lots_viewed[] = $lots[0]['id'];
    setcookie('lotsviewed_' . $user_name . $user_id, json_encode($lots_viewed), strtotime('+1 week'), '/');
  }

  $page_content = renderTemplate('templates/lot.php', [
    'is_auth' => $is_auth,
    'lot_name' => $lots[0]['name'],
    'lot_image' => $lots[0]['image_path'],
    'lot_alt' => $lots[0]['alt'],
    'lot_category' => $lots[0]['category'],
    'lot_price' => $lots[0]['price'],
    'lot_description' => $lots[0]['description']
  ]);

  $layout_content = renderTemplate('templates/layout.php', [
    'content' => $page_content,
    'categories' => $categories,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'user_avatar' => $user_avatar,
    'title' => $lots[0]['name'],
    'main_class' => ''
  ]);

  print($layout_content);
} else {
  http_response_code(404); // ошибка при обращении к несуществующему в базе лоту
}
?>