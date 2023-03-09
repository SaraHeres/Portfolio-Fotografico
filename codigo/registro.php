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
            <li><a href="./archivo.php" title="">Project</a></li>
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
              <a href="https://www.instagram.com" class="fa-icon" title="">
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
  <div class="section-container content-container">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">

          <?php

          require_once "DBconect.php";

          if (isset($_REQUEST['btn_register'])) //compruebe el nombre del botón "btn_register" y configúrelo
          {
            $username  = $_REQUEST['txt_username'];  //input nombre "txt_username"
            $email    = $_REQUEST['txt_email'];  //input nombre "txt_email"
            $password  = $_REQUEST['txt_password'];  //input nombre "txt_password"
            $role    = $_REQUEST['txt_role'];  //seleccion nombre "txt_role"

            if (empty($username)) {
              $errorMsg[] = "Ingrese nombre de usuario";  //Compruebe input nombre de usuario no vacío
            } else if (empty($email)) {
              $errorMsg[] = "Ingrese email";  //Revisar email input no vacio
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $errorMsg[] = "Ingrese email valido";  //Verificar formato de email
            } else if (empty($password)) {
              $errorMsg[] = "Ingrese password";  //Revisar password vacio o nulo
            } else if (strlen($password) < 6) {
              $errorMsg[] = "Password minimo 6 caracteres";  //Revisar password 6 caracteres
            } else if (empty($role)) {
              $errorMsg[] = "Seleccione rol";  //Revisar etiqueta select vacio
            } else {
              try {
                $select_stmt = $db->prepare("SELECT username, email FROM usuarios
										WHERE username=:uname OR email=:uemail"); 
                $select_stmt->bindParam(":uname", $username);
                $select_stmt->bindParam(":uemail", $email);      //parámetros de enlace
                $select_stmt->execute();
                $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
                if ($row["username"] == $username) {
                  $errorMsg[] = "Usuario ya existe";  //Verificar usuario existente
                } else if ($row["email"] == $email) {
                  $errorMsg[] = "Email ya existe";  //Verificar email existente
                } else if (!isset($errorMsg)) {
                  $insert_stmt = $db->prepare("INSERT INTO usuarios(username,email,password,role) VALUES(:uname,:uemail,:upassword,:urole)"); 
                  $insert_stmt->bindParam(":uname", $username);
                  $insert_stmt->bindParam(":uemail", $email);        
                  $insert_stmt->bindParam(":upassword", $password);
                  $insert_stmt->bindParam(":urole", $role);

                  if ($insert_stmt->execute()) {
                    $registerMsg = "Registro exitoso: Esperar página de inicio de sesión"; 
                    header("refresh:2;admin.php");
                  }
                }
              } catch (PDOException $e) {
                echo $e->getMessage();
              }
            }
          }

          ?>
          <div class="login-form">
            <center>
              <h2>Registrar Usuario</h2>
            </center>
            <form method="post" class="form-horizontal">

              <div class="form-group">
                <label class="col-sm-9 text-left">Usuario</label>
                <div class="col-sm-12">
                  <input type="text" name="txt_username" class="form-control" placeholder="Ingrese usuario" />
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-9 text-left">Email</label>
                <div class="col-sm-12">
                  <input type="text" name="txt_email" class="form-control" placeholder="Ingrese email" />
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-9 text-left">Password</label>
                <div class="col-sm-12">
                  <input type="password" name="txt_password" class="form-control" placeholder="Ingrese password" />
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-9 text-left">Seleccione tipo</label>
                <div class="col-sm-12">
                  <select class="form-control" name="txt_role">
                    <option value="" selected="selected"> - seleccione rol - </option>
                    <option value="admin">Administrador</option>
                    <option value="usuarios">Usuarios</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-12">
                  <input type="submit" name="btn_register" class="btn btn-primary btn-block" value="Registro">

                </div>
              </div>
              <p>
                <a href="admin.php" class="btn btn-danger">Cancelar</a>
              </p>


            </form>
          </div>
        </div>

      </div>

    </div>
  </div>
  </div>
  </div>
  </div>




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