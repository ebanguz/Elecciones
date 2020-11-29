<?php 

session_start();

unset($_SESSION['administracion']);

header('location: loginAdministracion.php');

?>