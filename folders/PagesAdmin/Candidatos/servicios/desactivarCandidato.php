<?php

require_once '../../../databaseHandler/databaseConnection.php';
require_once '../../../iDataBase/IDatabase.php';

require_once 'CandidatosHandler.php';

require_once '../../../helpers/FileHandler/JsonFileHandler.php';
require_once '../../../objects/Candidatos.php';

require_once '../../../helpers/FileHandler/JsonFileHandler.php';
require_once '../../../iDataBase/IDatabase.php';

session_start();

if (isset($_SESSION['administracion'])) {
    $administrador = json_decode($_SESSION['administracion']);
} else {
    header('Location: ../../Login/vista/loginAdministracion.php');
}

if(isset($_GET['id'])) {

    $ID = $_GET['id'];

    $context = new CandidatosHandler('../../../databaseHandler');
    //Simplemente se desactiva el candidato con el update
    $context->Deshabilitar($ID);

    header("Location: ../vistas/candidatoIndex.php");
}


?>