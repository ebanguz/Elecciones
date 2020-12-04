<?php

require_once '../../../layouts/layout.php';
require_once '../../../helpers/FileHandler/JsonFileHandler.php';
require_once '../../../databaseHandler/databaseMethods.php';
require_once '../../../objects/Administrador.php';

session_start();

$getUser = new DataBaseMethods('../../../databaseHandler');

if(isset($_SESSION['administracion'])) {

    header('Location: Administracion.php');
}

if (isset($_POST['usuario']) && isset($_POST['clave'])) {

    if ($_POST['usuario'] == "" || $_POST['clave'] == "") {
        echo "<script> alert('Llene los espacios en blanco.'); </script>";

    } else {

        $administrador = $getUser->getAdministrador($_POST['usuario'],$_POST['clave']);
        if($administrador == true) {

            $_SESSION['administracion'] = json_encode($administrador);
            header('Location: Administracion.php');
        }
    }
}

$layout = new Layout(true, 'Log in Administración', false);

?>

<?php $layout->Header(); ?>

<br>
<br>
<br>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <form class="form-signin" action="loginAdministracion.php" method="POST">
            <img class="mb-4" src="../../../assets/images/web/elecciones.jfif" alt="" width="350" height="100">
            <h1 class="h3 mb-3 font-weight-normal">Ingrese sus credenciales para continuar</h1>
            <label for="usuario" class="sr-only">Usuario</label>
            <input type="text" id="usuario" class="form-control" placeholder="Ingrese su usuario" name="usuario">
            <br>
            <label for="clave" class="sr-only">Contraseña</label>
            <input type="password" id="clave" class="form-control" placeholder="Ingrese su contraseña" name="clave">
            <br>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
            <p class="mt-5 mb-3 text-muted">© 2020-2022</p>
        </form>
    </div>
    <div class="col-md-4"></div>
</div>

<?php $layout->Footer(); ?>