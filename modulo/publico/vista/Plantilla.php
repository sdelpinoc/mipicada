<?php
namespace vista;

class Plantilla {

    public function __construct()
    {
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <title>base</title>
                <link rel="stylesheet" type="text/css" href="<?php echo URL;?>css/bootstrap.css">
                <link rel="stylesheet" type="text/css" href="<?php echo URL;?>css/estilos.css">
            </head>
            <body>
                 <header>
                    <h1>Heading 1 - Header</h1>
                    <div class="panel-heading">
                        Panel heading
                        <ul class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Library</a></li>
                            <li class="active">Data</li>
                        </ul>
                    </div>
                </header>
                <div class="container">
                    <div class="panel-body">

        <?php
    }

    public function __destruct()
    {
        ?>
                    </div>
                </div>
                <footer>
                    <div class="panel-footer">Panel footer</div>
                </footer>
                <script type="text/javascript" src="<?php echo URL;?>js/jquery-1.12.4.js"></script>
                <script type="text/javascript" src="<?php echo URL;?>js/bootstrap.min.js"></script>
            </body>
        </html>
        <?php
    }
}

$objPlantilla = new Plantilla();
?>