<?php

require_once '../../../databaseHandler/databaseConnection.php';
require_once '../../../iDataBase/IDatabase.php';

require_once 'CandidatosHandler.php';

require_once 'Candidatos.php';

require_once '../../../helpers/FileHandler/JsonFileHandler.php';
require_once '../../../iDataBase/IDatabase.php';

$ID = $_GET['id'];

$context = new CandidatosHandler('../../../databaseHandler');
//Simplemente se desactiva el candidato con el update
$context->Deshabilitar($ID);

header("Location: ../vistas/candidatoIndex.php");
exit();

?>