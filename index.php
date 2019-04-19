<?php
require_once ('functions.php');

session_start();

// запрос сиска категорий
$con = mysqli_connect('localhost', 'root', '', 'yeticave');
if($con == false) {
  print('Ошибка подключения:' . mesqli_connect_error());
} else {
  $query_result = mysqli_query($con, 'SELECT id, name FROM categories ORDER BY id');
  if (!$query_result){
    print('Ошибка MYSQL:' . mesqli_error());
  } else {
    $categories = mysqli_fetch_all($query_result, MYSQLI_ASSOC);
  }
}

// запрос списка лотов
$con = mysqli_connect('localhost', 'root', '', 'yeticave');
if($con == false) {
  print('Ошибка подключения:' . mesqli_connect_error());
} else {
  $query_result = mysqli_query($con, 'SELECT l.id, l.title AS name, c.NAME AS category, l.price, l.path AS image_path, l.alt_title AS alt, l.description FROM lots AS l JOIN categories AS c ON l.category_id = c.id');
  if (!$query_result){
    print('Ошибка MYSQL:' . mesqli_error());
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

$page_content = renderTemplate('templates/index.php', ['lots' => $lots]);
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
?>
