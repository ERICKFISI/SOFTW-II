<div class="">
    <div class="title">
        <div class="col-12">
            <h3>Visualizar Categoría</small></h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel ">
                <div class="x_title">
                    <a href="<?= base_url() . "/home/registrarcategoria"; ?>" class="btn btn-success">Registrar Categoría</a>
                    <a href="<?= base_url() . "/visualizarproducto"; ?>" class="btn btn-info">Visualizar Producto</a>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">

                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead class="text-center">
                                        <tr class="text-center">
                                            <th>Id</th>
                                            <th>Categoría</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php /*
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
                                                        <div class="col-12 mx-auto px-0"> 
                                                            <div class="col-12 mx-auto text-align px-0">
                                                                <a href="<?= base_url() . "/visualizarusuario/getupdate/" . $value["idusuario"]; ?>" class="btn btn-info btn-sm mx-auto col-12" ><i class="fa fa-pencil"></i>Modificar</a></div>
                                                            <div class="col-12 mx-auto text-align px-0" >
                                                                <a onclick="return alerta();" href="<?= base_url() . "/visualizarusuario/delete/" . $value['idusuario']; ?>"   class="btn btn-danger btn-sm mx-auto col-12"><i class="fa fa-trash-o"></i>Eliminar</a>
                                                            </div>
                                                        </div></td> 
                                                </tr>  
    <?php } endforeach;*/ ?>
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
<script type="text/javascript">
    function alerta()
    {
        var m = confirm("¿Está seguro que desea eliminar esta categoría?");
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