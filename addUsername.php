<?php
include './classes/user.php';
$oUser = new User();

$post = $_POST['post'];

if($post == 'login') {
    $sUsername = $_POST['username'];
    $sPassword = $_POST['password'];
    $oUser->login($sUsername, $sPassword);
} elseif ($post == 'regsiter') {
    $sUsername = $_POST['username'];
    $sPassword = $_POST['password'];
    $oUser->addUser($sUsername, $sPassword);
}