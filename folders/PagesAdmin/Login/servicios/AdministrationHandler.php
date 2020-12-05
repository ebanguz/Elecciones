<?php 

require_once '../../../databaseHandler/databaseConnection.php';
require_once '../../../iDataBase/IDatabase.php';

class AdministrationHandler implements IDataBaseHandler {

    private $connection;

    function __construct($directory)
    {
        $this->connection = new databaseConnection($directory);
    }

    function getActive() {

    }

    function getInactive() {
        
    }

    function getById($id) {

    }

    function Add($entity) {

    }

    function Habilitar($id) {

    }

    function Deshabilitar($id) {

    }

    function Edit($entity) {

    }

    public function getAdministrador($user, $password)
    {

        $stm = $this->connection->db->prepare('Select * FROM administracion where usuario = ? and clave = ?');
        $stm->bind_param('ss', $user, $password);
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return null;
        } else {

            $row = $result->fetch_object();
            $user = new Administrador();

            $user->id_usuario = $row->id_usuario;
            $user->usuario = $row->usuario;
            $user->clave = $row->clave;
            $user->nombre = $row->nombre;
            $user->apellido = $row->apellido;
            $user->cedula = $row->cedula;

            $stm->close();
            return $user;
        }
    }

    public function getAdministradorById($id)
    {

        $stm = $this->connection->db->prepare('Select * FROM administracion where id_usuario = ?');
        $stm->bind_param('i', $id);
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return null;
        } else {

            $row = $result->fetch_object();
            $user = new Administrador();

            $user->id_usuario = $row->id_usuario;
            $user->usuario = $row->usuario;
            $user->clave = $row->clave;
            $user->nombre = $row->nombre;
            $user->apellido = $row->apellido;
            $user->cedula = $row->cedula;

            $stm->close();
            return $user;
        }
    }
}

?>