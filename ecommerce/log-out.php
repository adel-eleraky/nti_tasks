<?php 
session_start();
unset($_SESSION['user']);
unset($_COOKIE);

header('location:login.php');

?>