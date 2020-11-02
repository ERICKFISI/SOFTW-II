
<div class="title">
    <div class="col-12">
        <h3>Visualizar Perfil</small></h3>
    </div>
</div>

<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel ">
            <div class="x_title">
                <a href="<?= base_url()."/registrarperfil";  ?>" class="btn btn-success">Registrar Perfil</a>
                <a href="<?= base_url()."/visualizarusuario";  ?>" class="btn btn-info">Visualizar Usuario</a>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">

                <table id="datatable" class="table table-striped table-bordered text-center" style="width:100%">
                <thead>
                    <tr>
                    <th>Id</th>
                    <th>Perfil</th>
                    <th>Permisos</th>
                    <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  foreach ( $Resultado as $key => $value ):
                    //if ($value["estadoperfil"] == 1 && $value["estadousuario"] == 1) {
                    ?>
                    <tr>  
                        <td> <?= $value[ "idperfil" ]   ?>  </td>
                        <td> <?= $value[ "nombreperfil" ] ?> </td>
                        <td> <?php foreach ($Resultado2 as $key2 => $value2 ) 
                         { 
                             if ( $value2["idperfil2"] == $value["idperfil"] ) {?> 
                        <li class=" list-unstyled col-6 offset-3 py-1 my-0"> <?= $value2["nombremodulo"];?> </li> <?php }} ?>
                        </td>
                        <td class="text-center row">
                        <div class="col-lg-4 col-md-5 mx-auto px-0">
                            <a href="<?= base_url()."/visualizarperfil/getupdate/".$value["idperfil"];?>" class="btn btn-info btn-sm mx-auto col-12" ><i class="fa fa-pencil tema">Modificar</i></a>
                        </div>
                        <div class="col-lg-4 col-md-5 mx-auto px-0" >
                            <a href="<?= base_url()."/visualizarperfil/delete/".$value['idperfil'];?>"  onclick="return alerta();" class="btn btn-danger btn-sm mx-auto col-12"><i class="fa fa-trash-o tema">Eliminar</i></a>
                        </div>
                        </td> 
                    </tr>  
                    <?php endforeach; ?>
                </tbody>
                </table>
            </div>
                    </div>
        </div>
            </div>
        </div>
    </div>

    <style type="text/css">
    .tema::before
    {
        margin-right: 5px !important;
    }
</style>
    <!-- /page content -->
    <script type="text/javascript">
     function alerta()
     {
         var m = confirm("¿Está seguro que desea eliminar este usuario?");
         if (m)
         {
             return true;
         }
         else
         {
             return false;
         }
     }
    </script>
    <!-- footer content -->
    <footer>
        <div class="pull-right">
        </div>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
</div>
</div>
