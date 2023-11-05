<?php


session_start();
setcookie('souvenir',NULL, -1);

unset($_SESSION['auth']);

$_SESSION['flash']['success']='vous ete deconnecté';



header('location:connection.php');