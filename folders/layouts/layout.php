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
    <div class="col-md-5"><h3 class="masthead-brand">Elecciones</h3></div>
    <div class="col-md-1"></div>
    <div class="col-md-3"><nav class="nav nav-masthead justify-content-center">
    <a class="nav-link active" href="{$this->directory}folders\webFiles\loginAdministracion.php">Panel Administrativo</a></div>
    <div class="col-md-3"><nav class="nav nav-masthead justify-content-center">
            <a class="nav-link active" href="{$this->logout}">Log out</a>
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
    EOF;

    echo $footer;

    }
}
