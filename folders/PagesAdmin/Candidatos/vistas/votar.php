<?php 

require_once '../../../helpers/FileHandler/JsonFileHandler.php';
require_once '../../Elecciones/servicios/EleccionesHandler.php';
require_once '../../Candidatos/servicios/CandidatosHandler.php';
require_once '../../../objects/Elecciones.php';
require_once '../../../objects/EleccionesAuditoria.php';
require_once '../../../objects/Candidatos.php';

session_start();

if(isset($_SESSION['ciudadano'])) {
    $currentCiudadano = json_decode($_SESSION['ciudadano']);
}

if(isset($_SESSION['elecciones'])) {
    $elecciones = json_decode($_SESSION['elecciones']);
} else {

    header('Location: ../../../VistaElector/vista/login.php');
}

$auditoria = new EleccionesHandler('../../../databaseHandler');
$candidato = new CandidatosHandler('../../../databaseHandler');

if(isset($_GET['id_candidato'])) {

    $idCandidato = $_GET['id_candidato'];
    $candidatoCurrent = $candidato->getById($idCandidato);

    $auditoria->AddAuditoria($elecciones->id_elecciones,$idCandidato,$candidatoCurrent->id_partido,$candidatoCurrent->id_puesto,$currentCiudadano->cedula);
    header('Location: ../../PuestoElectivo/vistas/Votacion.php');
}


?>