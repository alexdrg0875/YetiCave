<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 03.04.2019
 * Time: 19:29
 */
require_once ('data.php');
require_once ('userdata.php');
require_once ('functions.php');

session_start();

$is_auth = false;
$user_name = '';
$user_avatar = '';

$_SESSION = [];

header('Location: index.php');

?>