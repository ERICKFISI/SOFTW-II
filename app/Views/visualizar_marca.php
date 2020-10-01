<div class="">
    <div class="title">
        <div class="col-12">
            <h3>Visualizar Marca</small></h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel ">
                <div class="x_title">
                    <a href="<?= base_url() . "/home/registrarmarca"; ?>" class="btn btn-success">Registrar Marca</a>
                    <a href="<?= base_url() . "/visualizarProducto"; ?>" class="btn btn-info">Visualizar Producto</a>
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
                                            <th>Marca</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($marca as $key => $value):
                                                ?>
                                                <tr>  
                                                    <td class="text-center"> <?= $value["idmarca"] ?>  </td>
                                                    <td class="text-center"> <?= $value["marca"] ?> </td>
                                                    <td class="mx-auto">
                                                            <div class="col-8 col-lg-4 offset-lg-4 px-0">
                                                                <a href="<?= base_url() . "/visualizarMarca/getupdate/" . $value["idmarca"]; ?>" class="btn btn-info btn-sm col-12" ><i class="fa fa-pencil"></i>Modificar</a></div>
                                                            <div class="col-lg-4 offset-lg-4 col-8  px-0" >
                                                                <a onclick="return alerta();" href="<?= base_url() . "/visualizarMarca/delete/" . $value['idmarca']; ?>"   class="btn btn-danger btn-sm col-12"><i class="fa fa-trash-o"></i>Eliminar</a>
                                                            </div>
                                                        </td> 
                                                </tr>  
                                        <?php  endforeach; ?>
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
