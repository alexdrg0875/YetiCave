<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 01.04.2019
 * Time: 22:59
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
$lots_viewed = json_decode($_COOKIE['lotsviewed_' . $user_name . $user_id]);
//print ($_COOKIE['lotsviewed_' . $user_name . $user_id]);

// запрос списка категорий
if($connect_sql == false) {
  print('Ошибка подключения:' . mysqli_connect_error());
} else {
  $query_result = mysqli_query($connect_sql, "SELECT id, name, ename FROM categories ORDER BY id");
  if (!$query_result){
    print('Ошибка MYSQL:' . mysqli_error());
  } else {
    $categories = mysqli_fetch_all($query_result, MYSQLI_ASSOC);
  }
}

// запрос лотов по списку просмотренных
if($connect_sql == false) {
  print('Ошибка подключения:' . mysqli_connect_error());
} else {
  $query_result = mysqli_query($connect_sql, "SELECT l.id, l.title AS name, c.name, l.price, l.path AS image_path, l.alt_title AS alt, l.description FROM lots AS l JOIN categories AS c ON l.category_id = c.id");
  if (!$query_result){
    print('Ошибка MYSQL:' . mysqli_error());
  } else {
    $lots = mysqli_fetch_all($query_result, MYSQLI_ASSOC);
  }
}



$page_content = renderTemplate('templates/history.php', [
    'lots_viewed' => $lots_viewed,
  'categories' => $categories,
    'lots' => $lots
]);

$layout_content = renderTemplate('templates/layout.php', [
    'content' => $page_content,
    'categories' => $categories,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'user_avatar' => $user_avatar,
    'title' => 'История просмотров',
    'main_class' => ''
    ]);

print($layout_content);
?>