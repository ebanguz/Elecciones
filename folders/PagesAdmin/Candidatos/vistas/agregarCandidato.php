<?php

require_once '../../../layouts/layout.php';
require_once '../../../helpers/FileHandler/JsonFileHandler.php';
require_once '../../../databaseHandler/databaseMethods.php';
require_once '../../../objects/Puestos.php';
require_once '../../../objects/Partidos.php';
require_once '../../../objects/Candidatos.php';

session_start();

$layout = new Layout(true, 'Agregar Candidato', false);
$data = new DataBaseMethods('../../../databaseHandler');
$partidos = $data->getPartidosActives();
$puestos = $data->getPuestosActivos();

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

        $data->AddPartido($partido);
        echo "<script> alert('El puesto ha sido añadido correctamente.'); </script>";

        header('Location: ../../Login/vista/Administracion.php');
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
        <form enctype="multipart/form-data" action='agregarCandidato.php' method="POST">
            <div class="form-group">
                <label for="nombrecandidato">Nombre del Candidato</label>
                <input type="text" class="form-control" id="nombrecandidato" placeholder="Ingrese el nombre del nuevo candidato" name='nombre'>
            </div>
            <div class="form-group">
                <label for="apellidocandidato">Apellido del Candidato</label>
                <input type="text" class="form-control" id="apellidocandidato" placeholder="Ingrese el apellido del nuevo candidato" name='apellido'>
            </div>
            <div class="form-group">
                <label for="apellidocandidato">Apellido del Candidato</label>
                <input type="text" class="form-control" id="apellidocandidato" placeholder="Ingrese el apellido del nuevo candidato" name='apellido'>
            </div>
            <div class="form-group">
                <label for="name">Partido</label>
                <select class="form-control" name="id_partido" id="_partido">
                    <?php foreach ($partidos as $parts): ?>

                        <option value='<?= $parts->id_partido; ?>'><?= $parts->nombre; ?></option>

                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Puesto</label>
                <select class="form-control" name="id_puesto" id="id_puesto">
                    <?php foreach ($puestos as $post): ?>

                        <option value='<?= $post->id_puesto; ?>'><?= $post->nombre; ?></option>

                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="logo">Foto de perfil:</label>
                <input type="file" class="form-control" id="fotoperfil" name="fotoperfil">
            </div>
            <div class="form-group">
                <button class="btn btn-lg btn-danger btn-block" type="submit">Agregar</button>
            </div>
        </form>
    </div>
    <div class="col-md-4"></div>
</div>

<?php $layout->Footer(); ?>