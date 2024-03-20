<?php
$ds          = "/";  //1

$storeFolder = 'Documentos';   //2
// print_r("." . $ds. $storeFolder . $ds);
if (!empty($_FILES)) {

    $tempFile = $_FILES['file']['tmp_name'];          //3

    $targetPath = ".." . $ds. $storeFolder . $ds;  //4

    $targetFile =  $targetPath. $_FILES['file']['name'];  //5

    move_uploaded_file($tempFile,$targetFile); //6

    include('./conexion.php');
    $categoria_query = mysqli_query($con,"SELECT * FROM categoria WHERE id='".$_POST['tipoDoc']."' ");
    $categoria_data = mysqli_fetch_assoc($categoria_query);

    $archivos_query = mysqli_query($con,"SELECT * FROM archivo WHERE tipo_documento='".$_POST['tipoDoc']."' ");
    $archivos_contador = mysqli_num_rows($archivos_query);
    if($archivos_contador > 0){
      $codigo_num = $archivos_contador + 1;
    }else {
      $codigo_num = 1;
    }
    $codigo = $categoria_data['cod_categoria'].'-'.sprintf("%03d", $codigo_num);


    mysqli_query($con,"INSERT INTO `archivo` (`codigo`, `nombre`, `tipo_documento`, `documento_id`, `revision`, `emision`, `archivo`, `estado`) VALUES ('".$codigo."', '".$_FILES['file']['name']."', '".$_POST['tipoDoc']."', '".$_POST['idDocumento']."', '0', '".$_POST['emisionDoc']."', '".$targetFile."', '1')");
    mysqli_query($con,"UPDATE documento SET estado_documento = 4 WHERE id='".$_POST['idDocumento']."'");

}
?>
