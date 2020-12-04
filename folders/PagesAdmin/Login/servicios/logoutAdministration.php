<?php 

session_start();

unset($_SESSION['administracion']);

header('location: ../vista/loginAdministracion.php');

?>