<?php 

require_once 'folders\objects\Candidatos.php';
require_once 'folders\objects\Puestos.php';

session_start();

if(isset($_SESSION['votacion'])) {



} else {

    header('Location: folders\VistaElector\login\vista\login.php');
}

if(isset($_SESSION['administracion'])) {

    header('Location: folders\PagesAdmin\Login\vista\Administracion.php');
}

?>