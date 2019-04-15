<?php
require_once ('data.php');
require_once ('userdata.php');
require_once ('functions.php');

session_start();

if (isset($_SESSION['user_name'])){
  $is_auth = $_SESSION['is_auth'];
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
