<?php


session_start();

if (isset($_SESSION['administracion'])) {

    header('Location: folders/PagesAdmin/Login/vista/Administracion.php');
}

if (isset($_SESSION['elecciones'])) {

    $currentElecciones = json_decode($_SESSION['elecciones']);
    header('Location: folders\PagesAdmin\PuestoElectivo\vistas\Votacion.php');
} else {

    header('Location: folders\VistaElector\login\vista\login.php');
}

if (isset($_SESSION['ciudadano'])) {

    $ciudadanoUser = json_decode($_SESSION['ciudadano']);
    header('folders\PagesAdmin\PuestoElectivo\vistas\Votacion.php');
} else {
    header('Location: folders\VistaElector\login\vista\login.php');
}



?>