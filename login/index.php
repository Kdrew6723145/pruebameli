<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>LOGIN</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="./login.css">
  </head>
  <body>

    <!-- FORMULARIO DE LOGIN -->
    <div class="login-contenedor">

      <!-- IMAGEN DEL LOGIN -->
      <div class="login-imagen">

      </div>
      <div class="login-formulario container">
          <div class="row">
            <div class="input-field col s12">
              <h1>Iniciar Sesi&oacute;n</h1> <!-- H1 = TITULO -->
            </div>
          </div>

        <!-- INPUT = CUADROS DE ENTRADA DE TEXTO -->
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix" style="color:#2BBBAD;" id="email">email</i>
              <input type="email" class="login-email" for="email">
              <label>Correo</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix" style="color:#2BBBAD;" id="pwd">lock</i>
              <input type="password" class="login-pwd" for="pwd">
              <label>Contraseña</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
                <label>
                  <input type="checkbox" />
                  <span>Recordar Usuario</span>
                </label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <a href="#" style="color:#2BBBAD;">Olvidaste tu contraseña</a>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <a class="waves-effect waves-light login-boton-iniciar-sesion btn">Ingresar</a>
            </div>
          </div>
      </div>
    </div>
  </body>

  <!-- SE LLAMA A LA LIBRERIA PARA LAS ALERTAS O NOTIFICACIONES -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

  <!-- SCRIPT PARA LA VALIDACION DEL USUARIO -->
  <script type="text/javascript">
    $(document).ready(function(){

      // ACCION AL HACER CLICK AL BOTON DE INGRESO
      $('.login-boton-iniciar-sesion').on('click',function(){

        // SE CREA UNA CONEXION CON EL SERVIDOR
        $.ajax({

          // RUTA DEL ARCHIVO DEL SERVIDOR
          url: './ajax_login.php',

          // METODO DE INTERCAMBIO DE DATOS
          method: 'POST',

          // DATOS
          data: {
            login: 1,
            usuario: $('.login-email').val(),
            pwd: $('.login-pwd').val()
          },

          // ACCION SI EL USUARIO ES ENCONTRADO
          success: function(response){
            console.log(response);
            location.href = '../';
          },

          // ACCION SI EL USUARIO NO ESTA REGISTRADO
          statusCode: {

            // FILTRAMOS SI EL SERVIDOR NOS ENVIA UN CODIGO 403
            // QUE SIGNIFICA QUE EL USUARIO INGRESADO NO SE ENCUENTRA
            // EN LA BASE DE DATOS O NO TIENE PERMISOS
            403: function() {

              // SCRIPT DE LA LIBRERIA PARA CREAR LA NOTIFICACION DE ERROR
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'El usuario o la contraseña on son correctos',
              });
            }
          },
        });
      });
    });
  </script>
</html>
