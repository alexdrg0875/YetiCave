<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 29.03.2019
 * Time: 21:39
 */
require_once ('data.php');
require_once ('functions.php');

session_start();

if (isset($_SESSION['user_name'])){
  $is_auth = $_SESSION['is_auth'];
  $user_id = $_SESSION['user_id'];
  $user_email = $_SESSION['user_email'];
  $user_name = $_SESSION['user_name'];
  $user_avatar = $_SESSION['user_avatar'];
}

// проверяем наличие куки с lotsviewed
if (isset($_COOKIE['lotsviewed_' . $user_name . $user_id])){
    $lots_viewed = json_decode($_COOKIE['lotsviewed_' . $user_name . $user_id]);
} else {
    $lots_viewed = [];
}



if (isset($lots[$_GET['id']])) {
// проверяем просмотренный лот в массиве просмотренных, если нет, то добавляем в массив просмотренных
    $new_item = true;
    foreach ($lots_viewed as $viewed) {
        if ($_GET['id'] == $viewed) {
            //print_r($lots_viewed);
            $new_item = false;
        }
    }

    if ($new_item) {
        $lots_viewed[] = $_GET['id'];
        setcookie('lotsviewed_' . $user_name . $user_id, json_encode($lots_viewed), strtotime('+1 week'), '/');
    }

    $page_content = renderTemplate('templates/lot.php', [
        'is_auth' => $is_auth,
        'lot_name' => $lots[$_GET['id']]['name'],
        'lot_image' => $lots[$_GET['id']]['image_name'],
        'lot_alt' => $lots[$_GET['id']]['alt'],
        'lot_category' => $lots[$_GET['id']]['category'],
        'lot_price' => $lots[$_GET['id']]['price'],
        'lot_description' => $lots[$_GET['id']]['description']
    ]);

    $layout_content = renderTemplate('templates/layout.php', [
        'content' => $page_content,
        'categories' => $categories,
        'is_auth' => $is_auth,
        'user_name' => $user_name,
        'user_avatar' => $user_avatar,
        'title' => $lots[$_GET['id']]['name'],
        'main_class' => ''
    ]);

    print($layout_content);
} else {
    http_response_code(404);
}
?>