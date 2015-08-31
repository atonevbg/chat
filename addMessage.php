<?php
include './classes/chat.php';
$oChat = new Chat();

if($_POST) {
    $sMessage = $_POST['message'];
    $oChat->addMessage($_SESSION['user_id'], $sMessage);
}