<?php
include './classes/chat.php';
$oChat = new Chat();
$aMessages = $oChat->getMessages();
?>
<?php
    foreach($aMessages as $v) {
    ?>
    <p class="cm"><b><?= $v['Username'] ?> </b>says:<br><?= $v['Message'] ?></p>

<?php } ?>
