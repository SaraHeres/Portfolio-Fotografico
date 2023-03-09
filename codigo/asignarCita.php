<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width,initial-scale=1" name="viewport">
    <meta content="description" name="description">
    <meta name="google" content="notranslate" />
    <meta content="Mashup templates have been developped by Orson.io team" name="author">
    <meta name="msapplication-tap-highlight" content="no">

    <link rel="apple-touch-icon" sizes="180x180" href="./assets/apple-icon-180x180.png">
    <link href="./assets/favicon.ico" rel="icon">

    <title>Title page</title>

    <link href="./main.3da94fde.css" rel="stylesheet">
</head>

<body>

    <header>
        <nav class="navbar navbar-fixed-top navbar-default">
            <div class="container">
                <button type="button" class="navbar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <nav class="navbar-fullscreen" id="navbar-middle">
                    <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <ul class="navbar-fullscreen-links">
                        <li><a href="./index.html" title="">Home</a></li>
                        <li><a href="./archivo.html" title="">Projects</a></li>
                        <li><a href="./contacto.php" title="">Contact</a></li>
                        <li><a href="./about.html" title="">About me</a></li>
                        <li><a href="./login.php" title="">Login</a></li>
                    </ul>

                    <div class="footer-container">

                        <p><small>© Untitled | Website created with <a href="http://www.mashup-template.com/" title="Create website with free html template">Mashup Template</a>/<a href="https://www.unsplash.com/" title="Beautiful Free Images">Unsplash</a></small></p>
                        <p class="footer-share-icons">
                            <a href="https://www.twitter.com" class="fa-icon" title="">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                            <a href="https://www.linkedin.com" class="fa-icon" title="">
                                <i class="fa fa-instagram" aria-hidden="true"></i>
                            </a>
                            <a href="https://www.behance.com" class="fa-icon" title="">
                                <i class="fa fa-behance" aria-hidden="true"></i>
                            </a>
                            <a href="https://www.vimeo.com" class="fa-icon" title="">
                                <i class="fa fa-vimeo" aria-hidden="true"></i>
                            </a>
                        </p>

                    </div>


                </nav>

            </div>
        </nav>
    </header>

    <body>

        <?php

        include "DBconect.php";


        if (isset($_POST['btn_enviar'])) {
            $fecha        = $_POST['fecha'];
            $hora    = $_POST['hora'];
            $cliente = $_POST['cliente'];
            $tipo = $_POST['tipo'];
            $observaciones = $_POST['observaciones'];
            
            $sql = $db->prepare("INSERT INTO citas(citFecha,citHora,citCliente,citTipo,citObservaciones) 
        VALUES('$fecha', '$hora', '$cliente', '$tipo','$observaciones');");

            $sql->execute();
        }


        ?>

        <div class="section-container content-container">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-md-6">
                            <img src="./imagenes/archivo/17.jpg" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-6">
                            <div class="login-form">
                                <center>
                                    <h2>Agendar cita</h2>
                                </center>

                                <form method="post" class="form-horizontal">

                                    <div class="form-group">
                                        <label class="col-sm-9 text-left">Fecha Cita</label>
                                        <div class="col-sm-12">
                                            <input type="text" name="fecha" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-9 text-left">Hora Cita</label>
                                        <div class="col-sm-12">
                                            <input type="text" name="hora" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-9 text-left">Nombre cliente</label>
                                        <div class="col-sm-12">
                                            <input type="text" name="cliente" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-9 text-left">Tipo trabajo</label>
                                        <div class="col-sm-12">
                                            <input type="text" name="tipo" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-9 text-left">Observaciones</label>
                                        <div class="col-sm-12">
                                            <input type="textarea" name="observaciones" class="form-control" />
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="submit" name="btn_enviar" class="btn btn-primary btn-block" value="Enviar">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <a href="admin.php" class="btn btn-danger">Cancelar</a>
                                        </div>
                                    </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </body>


    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            navbarToggleSidebar();
            closeMenuBeforeGoingToPage();
            navActivePage();
        });
    </script>
    <script type="text/javascript" src="./main.4c6e144e.js"></script>
</body>

</html>