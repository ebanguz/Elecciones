<?php

    require_once '../../../layouts/layout.php';
    require_once '../../../helpers/FileHandler/JsonFileHandler.php';
    require_once '../../../iDataBase/IDatabase.php';
    require_once '../../Partidos/servicios/PartidosHandler.php';
    require_once '../../PuestoElectivo/servicios/PuestosHandler.php';
    require_once '../../../objects/Puestos.php';
    require_once '../../../objects/Partidos.php';
    require_once '../../../objects/Candidatos.php';
    require_once '../servicios/CandidatosHandler.php';

    session_start();
    //Aca pueden el editar
    $layout       = new Layout(true, 'Edición del Candidato', false);
    $dataPartidos = new PartidosHandler('../../../databaseHandler');
    $dataPuestos  = new PuestosHandler('../../../databaseHandler');
    $service      = new CandidatosHandler('../../../databaseHandler');

    $partidos = $dataPartidos->getActive();
    $puestos  = $dataPuestos->getActive();

    if (isset($_SESSION['administracion'])) {
        $administrador = json_decode($_SESSION['administracion']);
    } else {
        header('Location: ../../Login/vista/loginAdministracion.php');
    }

    if (isset($_GET['id'])) {
        $idCandidato     = $_GET['id'];
        $candidatoCharge = $service->getById($idCandidato);
        $estado          = $candidatoCharge->estado;
    }
    // ese id_candidato y estado q envie por POST, lo hice para q la consulta lo supiera. Ya que no lo podia coger
    // por GET. porque el POST lo sobreescribia
    if (isset($_POST['id_candidato']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['id_partido']) && isset($_POST['id_puesto']) && isset($_POST['estado'])) {

        if (($_POST['nombre']) == "" || ($_POST['apellido']) == "" || ($_POST['id_partido']) == "" || ($_POST['id_puesto']) == "" || ($_FILES['fotoperfil']) == "") {
            echo "<script> alert('Llene los espacios en blanco.'); </script>";

        } else {

            $CA = new Candidatos();

            $CA->id_candidato = $_POST['id_candidato'];
            $CA->nombre       = $_POST['nombre'];
            $CA->apellido     = $_POST['apellido'];
            $CA->id_partido   = $_POST['id_partido'];
            $CA->id_puesto    = $_POST['id_puesto'];
            $CA->foto_perfil  = $_FILES['fotoperfil'];
            $CA->estado       = $_POST['estado'];

            $service->Edit($CA);
            header("Location: candidatoIndex.php");
            exit();
        }

    }

?>

<?php $layout->Header();?>

<div class="row" style="margin: auto auto auto 20%; width:auto">
    <div class="col-md"></div>
    <div class="col-md-8">
        <form enctype="multipart/form-data" action="editarCandidato.php" method="POST">
            <input type="hidden" name='id_candidato' value="<?=$idCandidato;?>">
            <!-- Este input es simplemente para enviar por POST lo q explicaba mas arriba -->

            <div class="form-group">
                <label for="nombrecandidato">Nombre del Candidato</label>
                <input type="text" class="form-control" id="nombrecandidato"
                    placeholder="Ingrese el nombre del nuevo candidato" name='nombre'
                    value="<?=$candidatoCharge->nombre;?>">
            </div>
            <div class="form-group">
                <label for="apellidocandidato">Apellido del Candidato</label>
                <input type="text" class="form-control" id="apellidocandidato"
                    placeholder="Ingrese el apellido del nuevo candidato" name='apellido'
                    value="<?=$candidatoCharge->apellido;?>">
            </div>
            <div class="form-group">
                <label for="name">Partido</label>
                <select class="form-control" name="id_partido" id="_partido">

                    <?php foreach ($partidos as $parts): ?>

                    <option value='<?=$candidatoCharge->id_partido;?>'><?=$parts->nombre;?></option>

                    <?php endforeach;?>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Puesto</label>
                <select class="form-control" name="id_puesto" id="id_puesto">
                    <?php foreach ($puestos as $post): ?>

                    <option value='<?=$candidatoCharge->id_puesto;?>'><?=$post->nombre;?></option>

                    <?php endforeach;?>
                </select>
            </div>
            <div class="form-group">
                <label for="logo">Foto de perfil: </label>
                <img src="<?php echo "../../../assets/images/candidatos/" . $candidatoCharge->foto_perfil ?>"
                    class="card-img-top" alt="." style="margin:1% 0; width:30rem; display:block">
                <input type="file" class="form-control" id="fotoperfil" name="fotoperfil">

            </div>
            <input type="hidden" name='estado' value="<?=$estado;?>">
            <!-- Este input es simplemen para enviar por POST lo q explicaba mas arriba -->
            <div class="form-group">
                <button class="btn btn-lg btn-danger btn-block" type="submit">Editar</button>
            </div>
        </form>
    </div>
    <div class="col-md"></div>
</div>

<?php $layout->Footer();?>