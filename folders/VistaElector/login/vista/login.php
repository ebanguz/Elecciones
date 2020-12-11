<?php

require_once '../../../layouts/layout.php';
require_once '../../../helpers/FileHandler/JsonFileHandler.php';
require_once '../../../databaseHandler/databaseConnection.php';
require_once '../../../iDataBase/IDatabase.php';
require_once '../../../objects/Ciudadanos.php';
require_once '../../../PagesAdmin/Ciudadanos/servicios/CiudadanosHandler.php';
require_once '../../../PagesAdmin/PuestoElectivo/servicios/PuestosHandler.php';

session_start();

if (isset($_SESSION['administracion'])) {

    header('Location: ../../../PagesAdmin/Login/vista/Administracion.php');
}

if (isset($_SESSION['ciudadano'])) {

    header('Location: ../../../../index.php');
}

$layout = new Layout(true, 'Log in', true);
$ciudadano = new CiudadanosHandler('../../../databaseHandler');

if(isset($_POST['cedula'])) {

    $currentCiudadano = $ciudadano->getCiudadanoByCedula($_POST['cedula']);
    if(isset($_SESSION['elecciones'])) {

        if($currentCiudadano == true) {
            $_SESSION['ciudadano'] = json_encode($currentCiudadano);
    
            header('Location: ../../../../index.php');
        }

    } else {
        echo '<script>alert("No hay elecciones activas.")</script>';
    }

} 

?>

<?php $layout->Header(); ?>


<div class="pricing-header pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-5">Introducir su documento de indetidad.</h1>
</div>

<div class="row">
    <div class="col-md"></div>
    <div class="col-md-3">


        <form action="login.php" method="POST">
            <div class="form-group">
                <input type="text" class="form-control" id="documento" name="cedula" required placeholder="Ingrese su cédula">
                <div class="nav-scroller py-1 ">
                </div>
                <button type="submit" class="btn btn-block btn-primary" name="boton">Entrar</button>
            </div>

        </form>

    </div>
    <div class="col-md"></div>
</div>

<?php $layout->Footer(); ?>