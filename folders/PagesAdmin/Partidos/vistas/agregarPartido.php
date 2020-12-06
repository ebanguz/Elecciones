<?php

require_once '../../../layouts/layout.php';
require_once '../../../helpers/FileHandler/JsonFileHandler.php';
require_once '../../../iDataBase/IDatabase.php';
require_once '../../Partidos/servicios/PartidosHandler.php';
require_once '../../../objects/Puestos.php';
require_once '../../../objects/Partidos.php';

session_start();

$layout = new Layout(true, 'Agregar Partido', false);
$data = new PartidosHandler('../../../databaseHandler');

if (isset($_SESSION['administracion'])) {
    $administrador = json_decode($_SESSION['administracion']);
} else {
    header('Location: ../../Login/vista/loginAdministracion.php');
}

if(isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_FILES['logo'])) {
    if($_POST['nombre'] == "" || $_POST['descripcion'] == "" || $_FILES['logo'] == "") {
        echo "<script> alert('Llene los espacios en blanco.'); </script>";

    } else {

        $partido = new Partidos();
        $partido->nombre = $_POST['nombre'];
        $partido->descripcion = $_POST['descripcion'];

        $data->Add($partido);
        echo "<script> alert('El puesto ha sido añadido correctamente.'); </script>";

        header('Location: PartidoAdministracion.php');
    }
}

?>

<?php $layout->Header(); ?>

<br>
<br>
<br>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <img class="mb-4" src="../../../assets/images/web/puesto.jfif" alt="" width="350" height="120">
        <br>
        <form enctype="multipart/form-data" action='agregarPartido.php' method="POST">
            <div class="form-group">
                <label for="nombrepartido">Nombre del partido</label>
                <input type="text" class="form-control" id="nombrepartido" placeholder="Ingrese el nombre del nuevo puesto" name='nombre'>
            </div>
            <div class="form-group">
                <label for="descripcionpartido">Descripción del partido</label>
                <input type="text" class="form-control" id="descripcionpartido" placeholder="Ingrese una descripción del puesto" name='descripcion'>
            </div>
            <div class="form-group">
                <label for="logo">Cargar logo:</label>
                <input type="file" class="form-control" id="logo" name="logo">
            </div>
            <div class="form-group">
                <button class="btn btn-lg btn-danger btn-block" type="submit">Agregar</button>
            </div>
        </form>
    </div>
    <div class="col-md-4"></div>
</div>

<?php $layout->Footer(); ?>