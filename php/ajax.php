<?php
// SE REALIZA UNA CONEXION A LA BASE DE DATOS
include('./conexion.php');
// SE BUSCA LA ACCION QUE SE ESTA REALIZANDO
if(isset($_POST['programarFecha'])){
  // SE REALIZA LA ACTUALIZACION DE LOS DATOS EN LA BASE DE DATOS
  mysqli_query($con,"UPDATE documento SET fecha_programada='".$_POST['fecha']."' , estado_documento='3' WHERE id='".$_POST['idDocumento']."' ");
}
if(isset($_POST['reprogramar'])){
  mysqli_query($con,"UPDATE documento SET fecha_programada=NULL WHERE id='".$_POST['id']."' ");
}
?>
