<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 29.03.2019
 * Time: 21:39
 */
require_once ('data.php');
require_once ('functions.php');

#print_r($lots[$_GET['id']]);

// проверяем наличие куки с lotsviewed
if (isset($_COOKIE['lotsviewed'])){
    $lots_viewed = json_decode($_COOKIE['lotsviewed']);
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
        setcookie('lotsviewed', json_encode($lots_viewed), strtotime('+1 week'), '/');
    }

    $page_content = renderTemplate('templates/lot.php', [
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