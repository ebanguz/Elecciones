<?php

session_start();

unset($_SESSION['elecciones']);

header('Location: ../../Login/vista/Administracion.php');

?>