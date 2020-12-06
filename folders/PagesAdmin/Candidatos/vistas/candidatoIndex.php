<?php

    require_once '../../../layouts/layout.php';
    require_once '../../../helpers/FileHandler/JsonFileHandler.php';
    require_once '../servicios/CandidatosHandler.php';
    require_once '../../Partidos/servicios/PartidosHandler.php';
    require_once '../../PuestoElectivo/servicios/PuestosHandler.php';
    require_once '../../../iDataBase/IDatabase.php';

    $layout = new Layout(true, 'Candidatos', false);
    $data   = new CandidatosHandler('../../../databaseHandler');

    $candidatos = $data->getActive();

    //estas variables es para q cuando este desactivado el candidato, se ponga en modo oscuro. Mas adelante cambian dependiendo la condicion
    $message    = " NO ACTIVO";
    $background = " text-white bg-dark";
    $directorio = "activarCandidato.php?id=";
    $btnActivar = "Activar";

?>

<?php $layout->Header();?>

<!-- Puse ese style por unos erroes en unos margenes -->
<div class="container " style="margin: auto auto auto 20%; width:auto">


    <div class="row">


        <?php if (empty($candidatos)): ?>
        <div class="">
            <h2>No hay candidatos</h2>
            <a href="agregarCandidato.php" type="submit" class="btn btn-primary btn-lg btn-block">Agregar candidato</a>
        </div>
        <?php else: ?>
        <?php foreach ($candidatos as $candidato): ?>
        <!-- Aca cambia el modo dependiendo di esta activo o no. En el card pueden ver la diferencia -->
        <?php if ($candidato->estado == 1) {
                $message    = " ACTIVO";
                $background = "";
                $directorio = "desactivarCandidato.php?id=";
                $btnActivar = "Desactivar";
            }
        ?>
        <div class="card<?php echo $background ?>" style="width: 18rem;">
            <img src="<?php echo "../../../assets/images/candidatos/" . $candidato->foto_perfil ?>" class="card-img-top"
                alt=".">
            <div class="card-body">
                <h5 class="card-title"><?php echo $candidato->apellido; ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo $candidato->nombre; ?></h6>
                <p class="card-text">Postula como <?php $data->getPuestoNameById($candidato->id_puesto);?> para el
                    partido <?php $data->getPartidoNameById($candidato->id_partido);?> y se
                    encuentra<?php echo $message; ?></p>
                <a href="editarCandidato.php?id=<?php echo $candidato->id_candidato; ?>"
                    class="btn text-primary">Editar</a>

                <a href="../servicios/<?php echo $directorio . $candidato->id_candidato; ?>"
                    class="btn btn-primary"><?php echo $btnActivar ?></a>
            </div>
        </div>

        <?php endforeach;?>
        <a href="agregarCandidato.php" type="submit" class="btn btn-primary btn-lg btn-block my-5">Agregar candidato</a>

        <?php endif;?>
        <?php ?>

    </div>
</div>

<?php $layout->Footer();?>