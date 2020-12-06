<?php

class Layout {
    public $directory;
    public $action;
    public $title;
    public $type;
    public $logout;
    public $menu;

    function __construct($action, $title, $type) {
        $this->action    = $action;
        $this->directory = ($this->action) ? "../../../../" : "";
        $this->title     = $title;
        $this->type      = $type;
    }

    public function header() {
        $this->logout = ($this->type) ? $this->directory . "folders/VistaElector/login/servicio/logout.php" : $this->directory . "folders/PagesAdmin/Login/servicios/logoutAdministration.php";
        if($this->type == false) {
            $this->menu = <<<EOF
            <li class="nav-item">
        <a class="nav-link" href="{$this->directory}folders\PagesAdmin\PuestoElectivo/vistas\PuestoElectivo.php">
        <span data-feather="file"></span> Puesto Electivo
        </a>
        </li>

        <li class="nav-item">
        <a class="nav-link" href="{$this->directory}folders\PagesAdmin\Candidatos/vistas\candidatoIndex.php">
        <span data-feather="users"></span> Candidatos
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{$this->directory}folders\PagesAdmin\Ciudadanos/vistas\CiudadanosAdmin.php">
        <span data-feather="users"></span> Ciudadanos
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{$this->directory}folders\PagesAdmin\Elecciones/vistas\EleccionesAdmin.php">
        <span data-feather="bar-chart-2"></span> Elecciones
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{$this->directory}folders\PagesAdmin\Partidos/vistas\PartidoAdministracion.php">
        <span data-feather="layers"></span> Partidos
        </a>
        </li>
        EOF;
        } else {
            $this->menu = "";
        }

        $header = <<<EOF
        <!doctype html>
        <html lang="en">

        <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>$this->title</title>

        <link href="{$this->directory}folders\css\librarys\bootstrap\bootstrap.min.css" rel="stylesheet">
        <link href="{$this->directory}folders\css\dashboard.css" rel="stylesheet">
        </head>

        <header>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="{$this->directory}folders\PagesAdmin\Login/vista/Administracion.php">Administracion</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="{$this->logout}">Log out</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
        <li class="nav-item">
        <a class="nav-link" href="{$this->directory}index.php">
        <span data-feather="home"></span> Pag. Principal <span class="sr-only">(current)</span>
        </a>
        </li>
        {$this->menu}
        </ul>
        </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div class="jumbotron">
        <h1 class="h2">{$this->title}</h1>
        </div>
        </div>
        </main>
    </div>
    </div>
    </header>
    <body>

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
    <script src="{$this->directory}folders\js\librarys\jquery\jquery-3.5.1.min.js"></script>
    <script src="{$this->directory}folders\js\librarys\bootstrap\bootstrap.min.js"></script>
    <script src="{$this->directory}folders/js/librarys/toastr/toastr.min.js"></script>
    <script src="{$this->directory}folders\js\librarys\jquery\jquery-3.5.1.min.js"></script>
    EOF;

        echo $footer;

    }
}
?>