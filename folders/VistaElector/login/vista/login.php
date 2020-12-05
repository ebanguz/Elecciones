<?php

require_once '../../../layouts/layout.php';

session_start();

if (isset($_SESSION['administracion'])) {

    header('Location: ../../../PagesAdmin/Login/vista/Administracion.php');
}

$layout = new Layout(true, 'Log in', true);

?>

<?php $layout->Header(); ?>

<link rel="stylesheet" href="..\..\..\css\sigin.css">

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