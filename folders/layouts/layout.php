<?php

class Layout
{
    public $directory;
    public $action;
    public $title;
    public $type;
    public $logout;

    function __construct($action,$title,$type)
    {
        $this->action = $action;
        $this->directory = ($this->action) ? "../../" : "";
        $this->title = $title;
        $this->type = $type;
    }

    public function header()
    {
        $this->logout = ($this->type) ? $this->directory."folders/webFiles/logout.php" : $this->directory."folders/webFiles/logoutAdministration.php";

        $header = <<<EOF
        <html lang="en"><head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <title>{$this->title}</title>
    
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="{$this->directory}folders\css\librarys\bootstrap\bootstrap.min.css">
        <link rel="stylesheet" href="{$this->directory}folders\css\layout.css">
    
    
        <!-- Custom styles for this template -->
        <link href="cover.css" rel="stylesheet">
    </head>
    <body class="text-center">
        <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="masthead mb-auto">
        
    <div class="row">
    <div class="col-md-2"><a class="nav-link active btn btn-danger" href="{$this->directory}index.php">Inicio</a></div>
    <div class="col-md-4"><img class="mb-4" src="{$this->directory}folders/images/web/votos.jfif" alt="" width="350" height="50"></div>
    <div class="col-md-4"><nav class="nav nav-masthead justify-content-center">
    <a class="nav-link active btn btn-danger" href="{$this->directory}folders\webFiles\loginAdministracion.php">Panel Administrativo</a></div>
    <div class="col-md-2"><nav class="nav nav-masthead justify-content-center">
            <a class="nav-link active btn btn-danger" href="{$this->logout}">Log out</a>
    </nav></div>
    </div>
        
    </header>
    
    
    </body></html>
    EOF;

    echo $header;
    }

    public function Footer() {

        $footer = <<<EOF
        <footer class="mastfoot mt-auto">
        <div class="inner">
        <p>Elecciones para mandatarios.</p>
        </div>
    </footer>
    </div>
    
    
    </body></html>
    <script src="{$this->directory}folders/js/librarys/jquery/jquery-3.5.1.min.js"></script>
    <script src="{$this->directory}folders/js/librarys/bootstrap/bootstrap.min.jss"></script>
    <script src="{$this->directory}folders/js/librarys/toastr/toastr.min.js"></script>
    EOF;

    echo $footer;

    }
}
