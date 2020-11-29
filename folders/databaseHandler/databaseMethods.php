<?php

require_once 'databaseConnection.php';

class DataBaseMethods
{
    private $connection;

    function __construct($directory)
    {
        $this->connection = new databaseConnection($directory);
    }

    public function getAdministrador($user,$password)
    {

        $stm = $this->connection->db->prepare('Select * FROM administracion where usuario = ? and clave = ?');
        $stm->bind_param('ss', $user,$password);
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

    public function getPuestosActivos()
    {

        $tableList = array();

        $stm = $this->connection->db->prepare('Select * FROM Puestos WHERE estado = 1');
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return $tableList;
        } else {
            while ($row = $result->fetch_object()) {
                $user = new Puestos();

                $user->id_puesto = $row->id_puesto;
                $user->nombre = $row->nombre;
                $user->descripcion = $row->descripcion;
                $user->estado = $row->estado;

                array_push($tableList, $user);
            }

            $stm->close();
            return $tableList;
        }
    }

    public function getCandidatesActives()
    {

        $tableList = array();

        $stm = $this->connection->db->prepare('Select * FROM Candidatos WHERE estado = 1');
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return $tableList;
        } else {
            while ($row = $result->fetch_object()) {
                $user = new Candidatos();

                $user->id_candidato = $row->id_candidato;
                $user->nombre = $row->nombre;
                $user->apellido = $row->apellido;
                $user->id_partido = $row->id_partido;
                $user->id_puesto = $row->id_puesto;
                $user->foto_perfil = $row->foto_perfil;
                $user->estado = $row->estado;

                array_push($tableList, $user);
            }

            $stm->close();
            return $tableList;
        }
    }

    public function addPuesto($puesto)
    {

        $stm = $this->connection->db->prepare('insert into Puestos(nombre,descripcion) VALUES(?,?)');
        $stm->bind_param('ss', $puesto->nombre,$puesto->descripcion);
        $stm->execute();

    }

    public function totalFriends($id)
    {
        $array = array();
        $friendIds = $this->getFriends($id);
        foreach ($friendIds as $fi) {
            $new = $this->searchUser($fi->id_amigo);
            array_push($array, $new);
        }
        return $array;
    }

    public function getUserByUS_Pas($username, $password)
    {

        $stm = $this->connection->db->prepare('Select * FROM Usuario WHERE usuario = ? and clave = ?');
        $stm->bind_param('ss', $username, $password);
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return null;
        } else {
            $row = $result->fetch_object();
            $user = new Usuario();

            $user->id_usuario = $row->id_usuario;
            $user->nombre = $row->nombre;
            $user->apellido = $row->apellido;
            $user->telefono = $row->telefono;
            $user->correo = $row->correo;
            $user->usuario = $row->usuario;
            $user->clave = $row->clave;

            $stm->close();
            return $user;
        }
    }

    public function getPublications($id)
    {

        $tableList = array();

        $stm = $this->connection->db->prepare('Select * FROM Publicacion WHERE id_usuario = ?');
        $stm->bind_param('i', $id);
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return $tableList;
        } else {
            while ($row = $result->fetch_object()) {
                $user = new Publicacion();

                $user->id_publicacion = $row->id_publicacion;
                $user->publicacion = $row->publicacion;
                $user->fecha_hora = $row->fecha_hora;
                $user->id_usuario = $row->id_usuario;

                array_push($tableList, $user);
            }
        }


        $stm->close();
        return $tableList;
    }

    public function getPublicationById($idPublication)
    {


        $stm = $this->connection->db->prepare('Select * FROM Publicacion WHERE id_publicacion = ?');
        $stm->bind_param('i', $idPublication);
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return null;
        } else {

            $row = $result->fetch_object();

            $user = new Publicacion();

            $user->id_publicacion = $row->id_publicacion;
            $user->publicacion = $row->publicacion;
            $user->fecha_hora = $row->fecha_hora;
            $user->id_usuario = $row->id_usuario;
        }

        return $user;
    }

    public function getComments($idPublication)
    {

        $tableList = array();

        $stm = $this->connection->db->prepare('Select * FROM comentarios WHERE id_publicacion = ?');
        $stm->bind_param('i', $idPublication);
        $stm->execute();

        $result = $stm->get_result();

        if ($result->num_rows === 0) {

            return $tableList;
        } else {
            while ($row = $result->fetch_object()) {
                $user = new Comentarios();

                $user->id_comentario = $row->id_comentarios;
                $user->id_publicacion = $row->id_publicacion;
                $user->id_usuario = $row->id_usuario;
                $user->comentario = $row->comentario;
                $user->fecha_hora = $row->fecha_hora;

                array_push($tableList, $user);
            }
        }
        $stm->close();
        return $tableList;
    }

    public function addUser($dates)
    {

        $stm = $this->connection->db->prepare('insert into Usuario(nombre,apellido,telefono,correo,usuario,clave) values(?,?,?,?,?,?)');
        $stm->bind_param('ssssss', $dates->nombre, $dates->apellido, $dates->telefono, $dates->correo, $dates->usuario, $dates->clave);
        $stm->execute();
        $stm->close();
    }

    public function addFriend($friend)
    {

        $stm = $this->connection->db->prepare('insert into Amigos(id_usuario,id_amigo) values(?,?)');
        $stm->bind_param('ii', $friend->id_usuario, $friend->id_amigo);
        $stm->execute();
        $stm->close();

        $stm = $this->connection->db->prepare('insert into Amigos(id_usuario,id_amigo) values(?,?)');
        $stm->bind_param('ii', $friend->id_amigo, $friend->id_usuario);
        $stm->execute();
        $stm->close();
    }

    public function addPublication($publication)
    {

        $stm = $this->connection->db->prepare('insert into Publicacion(publicacion,id_usuario) values(?,?)');
        $stm->bind_param('ss', $publication->publicacion, $publication->id_usuario);
        $stm->execute();
        $stm->close();
    }

    public function addComment($comment)
    {

        $stm = $this->connection->db->prepare('insert into Comentarios(id_publicacion,id_usuario,comentario) values(?,?,?)');
        $stm->bind_param('iis', $comment->id_publicacion, $comment->id_usuario, $comment->comentario);
        $stm->execute();
        $stm->close();
    }

    public function editPublication($publication)
    {

        $stm = $this->connection->db->prepare('update Publicacion set publicacion = ? where id_publicacion = ?');
        $stm->bind_param('si', $publication->publicacion, $publication->id_publicacion);
        $stm->execute();
        $stm->close();
    }

    public function deletePublication($idPublication)
    {

        $stm = $this->connection->db->prepare('delete from Publicacion where id_publicacion = ?');
        $stm->bind_param('i', $idPublication);
        $stm->execute();
        $stm->close();
    }

    public function deleteFriend($id)
    {

        $stm = $this->connection->db->prepare('delete from Amigos where id_usuario = ?');
        $stm->bind_param('i', $id);
        $stm->execute();
        $stm->close();

        $stm = $this->connection->db->prepare('delete from Amigos where id_amigo = ?');
        $stm->bind_param('i', $id);
        $stm->execute();
        $stm->close();
    }
}
