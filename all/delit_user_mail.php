<?
$email = code($_GET['email']);

mysqli_query($CONNECT, "DELETE FROM `email_send_user` WHERE `email` = '$user_emeil'");
