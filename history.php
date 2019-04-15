<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 01.04.2019
 * Time: 22:59
 */
require_once ('data.php');
require_once ('userdata.php');
require_once ('functions.php');

session_start();

if (isset($_SESSION['user_name'])){
  $is_auth = $_SESSION['is_auth'];
  $user_name = $_SESSION['user_name'];
  $user_avatar = $_SESSION['user_avatar'];
}

$lots_viewed = json_decode($_COOKIE['lotsviewed']);

$page_content = renderTemplate('templates/history.php', [
    'lots_viewed' => $lots_viewed,
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