<?php

require_once ('init.php');
require_once ('functions.php');
require_once ('vendor/autoload.php');

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
    print('Ошибка MYSQL:' . mysqli_error($connect_sql));
  } else {
    $categories = mysqli_fetch_all($query_result, MYSQLI_ASSOC);
  }
}

//подсчет значений для пагинации страниц

$cur_page = $_GET['page'] ?? 1;

if($connect_sql == false) {
  print('Ошибка подключения:' . mysqli_connect_error());
} else {
  $query_result = mysqli_query($connect_sql, "SELECT l.id FROM lots AS l JOIN categories AS c ON l.category_id = c.id JOIN bets AS b ON b.lot_id = l.id WHERE l.user_id = $user_id GROUP BY b.lot_id");
  if (!$query_result){
    print('Ошибка MYSQL:' . mysqli_error($connect_sql));
  } else {
    $items_count = mysqli_num_rows($query_result);
    $pages_count = ceil($items_count / $page_items);     // $page_items - количество лотов на странице назначается в init.php
    $offset = ($cur_page - 1) * $page_items;
    $pages = range(1, $pages_count);
    if (mysqli_num_rows($query_result)) {
      $search_result = true;
    }
  }
}
// если есть ставки
if ($items_count > 0) {
// запрос списка лотов
  if($connect_sql == false) {
    print('Ошибка подключения:' . mysqli_connect_error());
  } else {
    $query_result = mysqli_query($connect_sql, "SELECT l.id, l.title AS name, l.dt_end, DATE_FORMAT(MAX(b.dt_add), '%d.%m.%y в %H:%i') AS bet_date,(SELECT MAX(b.bet) FROM bets AS b WHERE b.lot_id = l.id) AS max_bet, c.name AS category, MAX(b.bet) AS bet_value, l.path AS image_path, l.alt_title AS alt FROM lots AS l JOIN categories AS c ON l.category_id = c.id JOIN bets AS b ON b.lot_id = l.id WHERE l.user_id = $user_id GROUP BY b.lot_id LIMIT $page_items OFFSET $offset");
    if (!$query_result){
      print('Ошибка MYSQL:' . mysqli_error($connect_sql));
    } else {
      $lots = mysqli_fetch_all($query_result, MYSQLI_ASSOC);
    }
  }
} else {
  $search_result = false;
}

$page_content = renderTemplate('templates/my-lots.php', [
  'lots' => $lots,
  'categories' => $categories,
  'search_result' => $search_result,
  'pages' => $pages,
  'pages_count' => $pages_count,
  'cur_page' => $cur_page
]);

$layout_content = renderTemplate('templates/layout.php', [
  'content' => $page_content,
  'categories' => $categories,
  'is_auth' => $is_auth,
  'user_name' => $user_name,
  'user_avatar' => $user_avatar,
  'title' => 'Мои ставки',
  'main_class' => ''
]);

print($layout_content);
?>
