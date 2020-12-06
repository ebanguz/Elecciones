<?php

require_once 'folders/objects/Candidatos.php';
require_once 'folders/objects/Puestos.php';

session_start();

if (isset($_SESSION['administracion'])) {

    header('Location: folders/PagesAdmin/Login/vista/Administracion.php');
}

if(isset($_SESSION['elecciones'])) {

    $currentElecciones = json_decode($_SESSION['elecciones']);

} else {

    header('Location: folders\VistaElector\login\vista\login.php');
}

if(isset($_SESSION['ciudadano'])) {

    $ciudadanoUser = json_decode($_SESSION['ciudadano']);
} else {
    header('Location: folders\VistaElector\login\vista\login.php');
}

?>