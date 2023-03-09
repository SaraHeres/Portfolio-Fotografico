<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width,initial-scale=1" name="viewport">
    <meta content="description" name="description">
    <meta name="google" content="notranslate" />
    <meta content="Mashup templates have been developped by Orson.io team" name="author">

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

    <link rel="apple-touch-icon" sizes="180x180" href="./assets/apple-icon-180x180.png">
    <link href="./assets/favicon.ico" rel="icon">

    <title>Sara Heres-Fotografía</title>

    <link href="./main.3da94fde.css" rel="stylesheet">
</head>

<body>

    <!-- Add your content of header -->

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

                        <p>
                            <smallp>Sara Heres - 2022</smallp>
                        <p class="footer-share-icons">
                            <a href="https://www.twitter.com" class="fa-icon" title="">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                            <a href="https://www.linkedin.com" class="fa-icon" title="">
                                <i class="fa fa-instagram" aria-hidden="true"></i>
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
        <h3>

            <?php
            session_start();

            if (!isset($_SESSION['admin_login'])) {
                header("index.html");
            }

            if (isset($_SESSION['admin_login'])) {
            ?>
                Bienvenido,
            <?php
                echo $_SESSION['admin_login'];
            }
            ?>

        </h3>
        <center>
            <h3>Panel de administración</h3>
        </center>
        <br>
        <div class="container">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Citas
                            </div>

                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="18%">Fecha</th>
                                                <th width="24%">Hora</th>
                                                <th width="19%">Cliente</th>
                                                <th width="24%">tipo</th>
                                                <th width="24%">Observaciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require_once 'DBconect.php';
                                            $select_stmt = $db->prepare("SELECT citFecha,citHora,citCliente, citTipo, citObservaciones FROM citas");
                                            $select_stmt->execute();

                                            while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row["citFecha"]; ?></td>
                                                    <td><?php echo $row["citHora"]; ?></td>
                                                    <td><?php echo $row["citCliente"]; ?></td>
                                                    <td><?php echo $row["citTipo"]; ?></td>
                                                    <td><?php echo $row["citObservaciones"]; ?></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="container">
                <div>
                    <a href="registro.php"><button class="btn btn-danger text-left"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Registrar Usuario</button></a>
                </div>
                <br>
                <div class="container">
                    <div class="col-xs-100">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Mensajes
                                    </div>
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th width="18%">Nombre</th>
                                                        <th width="24%">Email</th>
                                                        <th width="12%">Telefono</th>
                                                        <th width="24%">Comentario</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    require_once 'DBconect.php';
                                                    $select_stmt = $db->prepare("SELECT username,email,telefono,comentario FROM mensajes");
                                                    $select_stmt->execute();

                                                    while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    ?>
                                                        <tr>

                                                            <td><?php echo $row["username"]; ?></td>
                                                            <td><?php echo $row["email"]; ?></td>
                                                            <td><?php echo $row["telefono"]; ?></td>
                                                            <td><?php echo $row["comentario"]; ?></td>


                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>

                                    <a href="cerrar_sesion.php"><button class="btn btn-danger text-left"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cerrar Sesion</button></a>
                                    <a href="asignarCita.php"><button class="btn btn-danger text-left"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Asignar Cita</button></a>
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