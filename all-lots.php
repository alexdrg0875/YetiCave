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
if ($connect_sql == false) {
  print('Ошибка подключения:' . mysqli_connect_error());
} else {
  $query_result = mysqli_query($connect_sql, 'SELECT id, name, ename FROM categories ORDER BY id');
  if (!$query_result) {
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
  $query_result = mysqli_query($connect_sql, "SELECT COUNT(*) as cnt FROM lots WHERE category_id = $_GET[cat]");
  if (!$query_result){
    print('Ошибка MYSQL:' . mysqli_error($connect_sql));
  } else {
    $items_count = mysqli_fetch_assoc($query_result)['cnt'];
    $pages_count = ceil($items_count / $page_items);     // $page_items - количество лотов на странице назначается в init.php
    $offset = ($cur_page - 1) * $page_items;
    $pages = range(1, $pages_count);
    if (mysqli_num_rows($query_result)) {
      $search_result = true;
    }
  }
}


// запрос списка лотов
if($connect_sql == false) {
  print('Ошибка подключения:' . mysqli_connect_error());
} else {
  $query_result = mysqli_query($connect_sql, "SELECT l.id, l.title AS name, l.dt_end, c.name AS category, l.category_id, l.price, MAX(b.bet) AS max_price, COUNT(b.bet) AS count_bets, l.path AS image_path, l.alt_title AS alt, l.description FROM lots AS l JOIN categories AS c ON l.category_id = c.id LEFT JOIN bets AS b ON b.lot_id = l.id WHERE c.id = $_GET[cat] GROUP BY l.id LIMIT $page_items OFFSET $offset");
  if (!$query_result){
    print('Ошибка MYSQL:' . mysqli_error($connect_sql));
  } else {
    $lots = mysqli_fetch_all($query_result, MYSQLI_ASSOC);
    if (mysqli_num_rows($query_result)) {
      $search_result = true;
    }
  }
}

$page_content = renderTemplate('templates/all-lots.php', [
  'lots' => $lots,
  'categories' => $categories,
  'pages' => $pages,
  'pages_count' => $pages_count,
  'cur_page' => $cur_page,
  'search_string' => $lots[0]['category'],
  'search_id' => $lots[0]['category_id'],
  'search_result' => $search_result
]);

$layout_content = renderTemplate('templates/layout.php', [
  'content' => $page_content,
  'categories' => $categories,
  'is_auth' => $is_auth,
  'user_name' => $user_name,
  'user_avatar' => $user_avatar,
  'title' => 'Все лоты',
  'main_class' => ''
]);

print($layout_content);
?>