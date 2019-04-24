<?php

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
if ($connect_sql == false) {
  print('Ошибка подключения:' . mysqli_connect_error());
} else {
  $query_result = mysqli_query($connect_sql, 'SELECT id, name, ename FROM categories ORDER BY id');
  if (!$query_result) {
    print('Ошибка MYSQL:' . mysqli_error());
  } else {
    $categories = mysqli_fetch_all($query_result, MYSQLI_ASSOC);
  }
}


// проверка строки поиска для исключения ошибки при отправке запроса в базу по средствам индекса FULLTEXT
if (strlen($_GET['search']) >= 3) {
// запрос списка лотов
  if($connect_sql == false) {
    print('Ошибка подключения:' . mysqli_connect_error());
  } else {
    $query_result = mysqli_query($connect_sql, 'SELECT l.id, l.title AS name, c.name AS category, l.price, MAX(b.bet) AS max_price, COUNT(b.bet) AS count_bets, l.path AS image_path, l.alt_title AS alt, l.description FROM lots AS l JOIN categories AS c ON l.category_id = c.id LEFT JOIN bets AS b ON b.lot_id = l.id WHERE MATCH (l.title, l.description) AGAINST (\''.$_GET['search'].'*\' IN BOOLEAN MODE)GROUP BY l.id');
    if (!$query_result){
      print('Ошибка MYSQL:' . mysqli_error());
    } else {
      $lots = mysqli_fetch_all($query_result, MYSQLI_ASSOC);
      if (mysqli_num_rows($query_result)) {
        $search_result = true;
      }
    }
  }
} else {
  $search_result = false;
}

if ($search_result) {
  $page_content = renderTemplate('templates/search.php', [
    'lots' => $lots,
    'categories' => $categories,
    'search_string' => $_GET['search']
  ]);
} else {
  $page_content = '<div class="container"><section class="lots"><h2>Ничего не найдено по вашему запросу</h2></section></div>';
}

$layout_content = renderTemplate('templates/layout.php', [
                                'content' => $page_content,
                                'categories' => $categories,
                                'is_auth' => $is_auth,
                                'user_name' => $user_name,
                                'user_avatar' => $user_avatar,
                                'title' => 'Результаты поиска',
                                'main_class' => ''
]);

print($layout_content);
?>
