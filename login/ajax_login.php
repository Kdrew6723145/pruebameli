<?php

// ABRIMOS UNA CONEXION TEMPORAL A LA BASE DE DATOS
include('../php/conexion.php');

if(isset($_POST['login'])){

  // SE HACE EL QUERY A LA BASE DE DATOS CON EL USUARIO Y LA CONTRASEÑA (SE ENCRIPTA LA CONTRASEÑA CON MD5 ANTES DE COMPRARAR)
  $usuario_query = mysqli_query($con, "SELECT tipo_usuario FROM usuario WHERE correo = '".$_POST['usuario']."' AND pwd = '".md5($_POST['pwd'])."' ");

  $total_usuario = mysqli_num_rows($usuario_query);
  // SI SE ENCUENTRA UNO O MAS USUARIOS CON LOS DATOS DE SESION SE MANDA UNA CONFIRMACION
  if($total_usuario > 0){

    // SE EXTRAE EL DATO DE TIPO DE USUARIO PARA MOSTRAR LA INFORMACION DE ACUERDO A SU USUARIO
    $usuario_datos = mysqli_fetch_assoc($usuario_query);
    $respuesta = $usuario_datos['tipo_usuario'];
    echo $respuesta;
  }else{

    // SI NO SE ENCUENTRAN USUARIOS SE ENVIA UN ERROR 403
    http_response_code(403);
  }
  $mysqli -> close();

}

?>
