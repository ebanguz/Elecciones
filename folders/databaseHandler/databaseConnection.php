<?php

class databaseConnection {
    public $db;
    private $json;

    function __construct($directory)
    {
        $this->json = new JsonFileHandler($directory,'connection');
        $read = $this->json->getJSON();
        $this->db = new mysqli($read->server,$read->user,$read->password,$read->database);

        if($this->db->connect_error) {

            exit('Error de conexión');
        }
    }
}
?>
