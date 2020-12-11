<?php

require_once '../../../layouts/layout.php';
require_once '../../../helpers/FileHandler/JsonFileHandler.php';
require_once '../../../iDataBase/IDatabase.php';
require_once '../../../databaseHandler/databaseConnection.php';
require_once '../../PuestoElectivo/servicios/PuestosHandler.php';
require_once '../../../objects/Puestos.php';

session_start();

$layout = new Layout(true, 'Modificar Puesto', false);
$data = new PuestosHandler('../../../databaseHandler');

if (isset($_SESSION['administracion'])) {
    $administrador = json_decode($_SESSION['administracion']);
} else {
    header('Location: ../../Login/vista/loginAdministracion.php');
}

if(isset($_GET['id_puesto'])) {

    $idPuesto = $_GET['id_puesto'];
    $puestoCharge = $data->getById($idPuesto);

    if(isset($_POST['nombre']) && isset($_POST['descripcion'])) {

        if(isset($_GET['id_puesto'])) {
            $idPuesto = $_GET['id_puesto'];

            if($_POST['nombre'] == "" || $_POST['descripcion'] == "") {
                echo "<script> alert('Llene los espacios en blanco.'); </script>";
        
            } else {
        
                $puesto = new Puestos();
                $puesto->id_puesto = $idPuesto;
                $puesto->nombre = $_POST['nombre'];
                $puesto->descripcion = $_POST['descripcion'];
        
                $data->Edit($puesto);
                echo "<script> alert('El puesto ha sido añadido correctamente.'); </script>";
        
                header('Location: PuestoElectivo.php');
            }
        }
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
        <form action='modificarPuesto.php?id_puesto=<?= $idPuesto; ?>' method="POST">
            <div class="form-group">
                <label for="nombrepuesto">Nombre del puesto</label>
                <input type="text" class="form-control" id="nombrepuesto" placeholder="Ingrese el nuevo nombre del puesto" value="<?= $puestoCharge->nombre; ?>" name='nombre'>
            </div>
            <div class="form-group">
                <label for="descripcionpuesto">Descripción</label>
                <input type="text" class="form-control" id="descripcionpuesto" placeholder="Ingrese una descripción del puesto" value="<?= $puestoCharge->descripcion; ?>" name='descripcion'>
            </div>
            <div class="form-group">
                <button class="btn btn-lg btn-danger btn-block" type="submit">Agregar</button>
            </div>
        </form>
    </div>
    <div class="col-md-4"></div>
</div>

<?php $layout->Footer(); ?>