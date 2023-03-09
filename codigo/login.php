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

  <title>Sara Heres-Fotografía</title>

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

    <div class="section-container content-container">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">

            <?php
            require_once 'DBconect.php';
            session_start();
            if (isset($_SESSION["admin_login"]))  
            {
              header("location: admin.php");
            }
            if (isset($_SESSION["cliente_login"]))  
            {
              header("location: cliente.php");
            }
            if (isset($_SESSION["usuarios_login"]))  
            {
              header("location: cliente.php");
            }

            if (isset($_REQUEST['btn_login'])) {
              $email    = $_REQUEST["txt_email"];  
              $password  = $_REQUEST["txt_password"];  
              $role    = $_REQUEST["txt_role"];   

              if (empty($email)) {
                $errorMsg[] = "Por favor ingrese Email";  //Revisar email
              } else if (empty($password)) {
                $errorMsg[] = "Por favor ingrese Password";  //Revisar password vacio
              } else if (empty($role)) {
                $errorMsg[] = "Por favor seleccione rol ";  //Revisar rol vacio
              } else if ($email and $password and $role) {
                try {
                  $select_stmt = $db->prepare("SELECT email,password,role FROM usuarios
										WHERE
										email=:uemail AND password=:upassword AND role=:urole");
                  $select_stmt->bindParam(":uemail", $email);
                  $select_stmt->bindParam(":upassword", $password);
                  $select_stmt->bindParam(":urole", $role);
                  $select_stmt->execute();  

                  while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                    $dbemail  = $row["email"];
                    $dbpassword  = $row["password"];
                    $dbrole    = $row["role"];
                  }
                  if ($email != null and $password != null and $role != null) {
                    if ($select_stmt->rowCount() > 0) {
                      if ($email == $dbemail and $password == $dbpassword and $role == $dbrole) {
                        switch ($dbrole)    
                        {
                          case "admin":
                            $_SESSION["admin_login"] = $email;
                            $loginMsg = "Admin: Inicio sesión con éxito";
                            header("refresh:3;admin.php");
                            break;

                          case "personal";
                            $_SESSION["cliente_login"] = $email;
                            $loginMsg = "Personal: Inicio sesión con éxito";
                            header("refresh:3;cliente.php");
                            break;

                          case "usuarios":
                            $_SESSION["usuarios_login"] = $email;
                            $loginMsg = "Usuario: Inicio sesión con éxito";
                            header("refresh:3;cliente.php");
                            break;

                          default:
                            $errorMsg[] = "correo electrónico o contraseña o rol incorrectos";
                        }
                      } else {
                        $errorMsg[] = "correo electrónico o contraseña o rol incorrectos";
                      }
                    } else {
                      $errorMsg[] = "correo electrónico o contraseña o rol incorrectos";
                    }
                  } else {
                    $errorMsg[] = "correo electrónico o contraseña o rol incorrectos";
                  }
                } catch (PDOException $e) {
                  $e->getMessage();
                }
              } else {
                $errorMsg[] = "correo electrónico o contraseña o rol incorrectos";
              }
            }
            
            ?>
            <div class="login-form">
              <center>
                <h2>Iniciar sesión</h2>
              </center>
              <form method="post" class="form-horizontal">
                <div class="form-group">
                  <label class="col-sm-6 text-left">Email</label>
                  <div class="col-sm-12">
                    <input type="text" name="txt_email" class="form-control" placeholder="Ingrese email" />
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-6 text-left">Password</label>
                  <div class="col-sm-12">
                    <input type="password" name="txt_password" class="form-control" placeholder="Ingrese passowrd" />
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-6 text-left">Seleccionar rol</label>
                  <div class="col-sm-12">
                    <select class="form-control" name="txt_role">
                      <option value="" selected="selected"> - selecccionar rol - </option>
                      <option value="admin">Admin</option>
                      <option value="usuarios">Cliente</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-12">
                    <input type="submit" name="btn_login" class="btn btn-success btn-block" value="Iniciar Sesion">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-12">
                    ¿No tienes una cuenta?<a href="contacto.php">
                      <p class="text-info">Solicitar cuenta</p>
                    </a>
                  </div>
                </div>

              </form>
            </div>
           
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