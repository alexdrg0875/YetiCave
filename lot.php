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
  $query_result = mysqli_query($connect_sql, "SELECT id, name, ename FROM categories ORDER BY id");
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
  $query_result = mysqli_query($connect_sql, "SELECT l.id, l.user_id, l.title AS name, c.name AS category, l.price, l.bet_step, l.path AS image_path, l.alt_title AS alt, l.description FROM lots AS l JOIN categories AS c ON l.category_id = c.id WHERE l.id = $_GET[id]");
  if (!$query_result){
    print('Ошибка MYSQL:' . mysqli_error());
  } else {
    $lots = mysqli_fetch_all($query_result, MYSQLI_ASSOC);
  }
}

// запрос списка ставок по лоту _GET[id]
if($connect_sql == false) {
  print('Ошибка подключения:' . mysqli_connect_error());
} else {
  $query_result = mysqli_query($connect_sql, "SELECT u.name, b.bet, DATE_FORMAT(b.dt_add, '%d.%m.%y в %H:%i') AS dt_add FROM bets AS b JOIN users AS u ON b.user_id = u.id WHERE b.lot_id = $_GET[id] ORDER BY b.bet DESC LIMIT 10");
  if (!$query_result){
    print('Ошибка MYSQL:' . mysqli_error());
  } else {
    $bets = mysqli_fetch_all($query_result, MYSQLI_ASSOC);
    if ($lots[0]['price'] < $bets[0]['bet']){ // вычисление максимальной ставки по лоту
      $max_bet = $bets[0]['bet'];
    } else {
      $max_bet = $lots[0]['price'];
    }
    $row_cnt = mysqli_num_rows($query_result);
  }
}

// выполняем при попадании на страницу с кнопки ставка

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $new_bet = $_POST['cost'] ?? '';
  if ($new_bet >= ($max_bet + $lots[0]['bet_step'])) {
    if(!$connect_sql) { //добавление ставки в базу
      print('Ошибка подключения:' . mysqli_connect_error());
    } else {
      $stmt = mysqli_prepare($connect_sql, "INSERT INTO bets (lot_id, user_id, dt_add, bet) VALUES (?,?,?,?)");
      if (mysqli_stmt_bind_param($stmt,'iisi',$lots[0]['id'],$user_id, date('Y-m-d H:i:s'), $new_bet)) {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($connect_sql);
      } else {
        print('Error run mysqli_stmt_bind_param: '.mysqli_error($connect_sql));
        header('Location: lot.php?id=' . $lots[0]['id']);
      }
    }
    header('Location: lot.php?id=' . $lots[0]['id']);
  } else {
    header('Location: lot.php?id=' . $lots[0]['id']);
  }
} else { // если загрузили страницу по ссылке

// проверяем наличие куки с lotsviewed для сбора инфо для history page
  if (isset($_COOKIE['lotsviewed_' . $user_name . $user_id])) {
    $lots_viewed = json_decode($_COOKIE['lotsviewed_' . $user_name . $user_id]);
  } else {
    $lots_viewed = [];
  }


// проверяем просмотренный лот в массиве просмотренных, если нет, то добавляем в массив просмотренных
  if (!empty($lots)) {
    if (!empty($lots_viewed)) {
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
      'categories' => $categories,
      'is_auth' => $is_auth,
      'user_id' => $user_id,
      'lot_user_id' => $lots[0]['user_id'],
      'lot_id' => $lots[0]['id'],
      'lot_name' => $lots[0]['name'],
      'lot_image' => $lots[0]['image_path'],
      'lot_alt' => $lots[0]['alt'],
      'lot_category' => $lots[0]['category'],
      'lot_price' => $lots[0]['price'],
      'lot_bet_step' => $lots[0]['bet_step'],
      'lot_description' => $lots[0]['description'],
      'bets' => $bets,
      'max_bet' => $max_bet,
      'row_cnt' => $row_cnt,
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
}
?>