<?php
require_once ('data.php');
require_once ('functions.php');

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
