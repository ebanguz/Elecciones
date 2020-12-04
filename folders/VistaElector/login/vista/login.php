<?php

require_once '../../../layouts/layout.php';

session_start();

if(isset($_SESSION['administracion'])) {

    header('Location: ../../../PagesAdmin/Login/vista\Administracion.php');
}


$layout = new Layout(true, 'Log in',true);

?>

<?php $layout->Header(); ?>

<br>
<br>
<br>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <form class="form-signin">
            <img class="mb-4" src="../../../assets/images/web/elecciones.jfif" alt="" width="350" height="120">
            <h1 class="h3 mb-3 font-weight-normal">Ingrese su cédula para continuar</h1>
            <label for="cedula" class="sr-only">Usuario</label>
            <input type="text" id="cedula" class="form-control" placeholder="Ingrese su cédula">
            <br>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
            <p class="mt-5 mb-3 text-muted">© 2020-2022</p>
        </form>
    </div>
    <div class="col-md-4"></div>
</div>

<?php $layout->Footer(); ?>