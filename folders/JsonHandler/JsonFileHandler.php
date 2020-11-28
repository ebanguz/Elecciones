<?php 

class JsonFileHandler{
    private $directory;
    private $name;
    
    function __construct($directory = '../databaseHandler')
    {
        $this->directory = $directory;
        $this->name = 'connection';
    }

    public function getJSON() {
        $path = $this->directory . '/' . $this->name . '.json';
        $file = fopen($path, 'r');
        $fileDecode = fread($file, filesize($path));
        fclose($file);

        return json_decode($fileDecode);
    }
}

?>