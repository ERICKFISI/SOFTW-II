<?php

/*try {
  require "conexion.php";
  $query=$conexion->prepare("SELECT * FROM usuario");
  $query->execute();
  $Resultado=$query->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
  $e->getMessage();
  es probable que no funcione porque se debe eliminar esta parte del código, y alguna más
}*/?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DataTables | Gentelella</title>

    <!-- Bootstrap -->
    <link href="<?php   echo base_url()."/public/cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" ?>">
    <link href="<?php   echo base_url()."/public/vendors/bootstrap/dist/css/bootstrap.min.css" ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php   echo base_url()."/public/vendors/font-awesome/css/font-awesome.min.css" ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php   echo base_url()."/public/vendors/nprogress/nprogress.css" ?>" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php   echo base_url()."/public/vendors/iCheck/skins/flat/green.css" ?>" rel="stylesheet">
    <!-- Datatables -->
    
    <link href="<?php   echo base_url()."/public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css"  ?>"rel="stylesheet">
    <link href="<?php   echo base_url()."/public/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" ?>" rel="stylesheet">
    <link href="<?php   echo base_url()."/public/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" ?>" rel="stylesheet">
    <link href="<?php   echo base_url()."/public/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" ?>" rel="stylesheet">
    <link href="<?php   echo base_url()."/public/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css"  ?>"rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php   echo base_url()."/public/build/css/custom.min.css" ?>" rel="stylesheet">
  </head>
</body>