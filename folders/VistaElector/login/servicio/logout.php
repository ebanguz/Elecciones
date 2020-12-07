<?php 

session_start();

unset($_SESSION['ciudadano']);

header('Location: ../vista/login.php');

?>