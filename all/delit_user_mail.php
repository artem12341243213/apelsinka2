<?
$email = code($_GET['email']);
if (mysqli_query($CONNECT, "DELETE FROM `email_send_user` WHERE `email` = '$email'"))
    print_r("Ваша почта была удаленна из базы данных, больше вы не будете получать уведомление на почту");
?>
<br>
<a href="home">Главная страницы</a>