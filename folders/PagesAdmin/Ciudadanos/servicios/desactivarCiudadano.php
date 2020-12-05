<?php 

require_once '../../../helpers/FileHandler/JsonFileHandler.php';
require_once '../../../iDataBase/IDatabase.php';
require_once '../../Ciudadanos/servicios/CiudadanosHandler.php';

session_start();

if (isset($_SESSION['administracion'])) {
    $administrador = json_decode($_SESSION['administracion']);
} else {
    header('Location: ../../Login/vista/loginAdministracion.php');
}

$data = new CiudadanosHandler('../../../databaseHandler');

if(isset($_GET['cedula'])) {

    $cedula = $_GET['cedula'];

    $data->Deshabilitar($cedula);

    header('Location: ../vistas/CiudadanosAdmin.php');
}

?>