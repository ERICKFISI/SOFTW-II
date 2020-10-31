<div class="">
    <div class="title">
        <div class="col-12">
            <h3>Visualizar Usuario</small></h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel ">
                <div class="x_title">
                    <a href="<?= base_url() . "/home/registrarusuario"; ?>" class="btn btn-success">Registrar Usuario</a>
                    <a href="<?= base_url() . "/visualizarperfil"; ?>" class="btn btn-info">Visualizar Perfil</a>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">

                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Nombre Usuario</th>
                                            <th>Teléfono/Celular</th>
                                            <th>Perfil</th>
                                            <th>DNI</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($Resultado as $key => $value):
                                            if ($value["estadoperfil"] == 1 && $value["estadousuario"] == 1) {
                                                ?>
                                                <tr>  
                                                    <td> <?= $value["idusuario"] ?>  </td>
                                                    <td> <?= $value["nombre"] ?> </td>
                                                    <td> <?= $value["nombreusuario"] ?> </td>
                                                    <td> <?= $value["telefono"] ?> </td>
                                                    <td> <?= $value["nombreperfil"] ?> </td>
                                                    <td> <?= $value["dni"] ?> </td>
                                                    <td>
                                                            <div class="col-12 mx-auto text-align px-0">
                                                                <a href="<?= base_url() . "/visualizarusuario/getupdate/" . $value["idusuario"]; ?>" class="btn btn-info btn-sm mx-auto col-12" ><i class="fa fa-pencil tema">Modificar</i></a>
                                                             </div>
                                                            <div class="col-12 mx-auto text-align px-0" >
                                                                <a onclick="return alerta();" href="<?= base_url() . "/visualizarusuario/delete/" . $value['idusuario']; ?>"   class="btn btn-danger btn-sm mx-auto col-12"><i class="fa fa-trash-o tema">Eliminar</i></a>
                                                            </div>
                            </td>
                                                </tr>  
    <?php } endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <div class="pull-right">
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>
<style type="text/css">
    .tema::before
    {
        margin-right: 5px !important;
    }
</style>
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
