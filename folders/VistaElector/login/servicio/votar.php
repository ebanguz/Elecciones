<?php 

require_once '../../../helpers/FileHandler/JsonFileHandler.php';
require_once '../../../iDataBase/IDatabase.php';
require_once '../../../PagesAdmin/Elecciones/servicios/EleccionesHandler.php';
require_once '../../../PagesAdmin/Candidatos/servicios/CandidatosHandler.php';
require_once '../../../PagesAdmin/PuestoElectivo/servicios/PuestosHandler.php';
require_once '../../../PagesAdmin/Partidos/servicios/PartidosHandler.php';
require_once '../../../databaseHandler/databaseConnection.php';
require_once '../../../objects/Elecciones.php';
require_once '../../../objects/EleccionesAuditoria.php';
require_once '../../../objects/Candidatos.php';
require_once '../../../objects/Puestos.php';
require_once '../../../objects/Partidos.php';
require_once '../../../helpers/EmailHandler/Exception.php';
require_once '../../../helpers/EmailHandler/PHPMailer.php';
require_once '../../../helpers/EmailHandler/SMTP.php';
require_once '../../../helpers/EmailHandler/EmailHandler.php';

session_start();

if(isset($_SESSION['ciudadano'])) {
    $currentCiudadano = json_decode($_SESSION['ciudadano']);
}

if(isset($_SESSION['elecciones'])) {
    $elecciones = json_decode($_SESSION['elecciones']);
} else {

    header('Location: ../vista/login.php');
}

$auditoria = new EleccionesHandler('../../../databaseHandler');
$candidato = new CandidatosHandler('../../../databaseHandler');
$puesto = New PuestosHandler('../../../databaseHandler');
$partido = new PartidosHandler('../../../databaseHandler');
$emailHandler = new EmailHandler('../../../helpers/EmailHandler');

if(isset($_GET['id_candidato'])) {

    $idCandidato = $_GET['id_candidato'];
    $candidatoCurrent = $candidato->getById($idCandidato);

    $auditoria->AddAuditoria($elecciones->id_elecciones,$idCandidato,$candidatoCurrent->id_partido,$candidatoCurrent->id_puesto,$currentCiudadano->cedula);
    if($auditoria == true) {
        $currentPuesto = $puesto->getById($candidatoCurrent->id_puesto);
        $currentPartido = $partido->getById($candidatoCurrent->id_puesto);
        $body = "<h3>Hola" . $currentCiudadano->nombre . " has votado por el candidato ". $candidatoCurrent->nombre . " " . $candidatoCurrent->apellido . "
        del partido " . $currentPartido->nombre . "el cual aspira para el puesto de " . $currentPuesto->nombre . ", ¡Gracias por votar!.</h3>";
        $emailHandler->sendEmail($currentCiudadano->email,"Votación",$body);
    }
    header('Location: ../../../../index.php');
}


?>