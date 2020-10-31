<div class="">
    <div class="title">
        <div class="col-12">
            <h3>Visualizar Producto</small></h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel ">
                <div class="x_title">
                    <a href="<?= base_url() . "/home/registrarproducto"; ?>" class="btn btn-success">Registrar Producto</a>
                    <a href="<?= base_url() . "/visualizarcategoria"; ?>" class="btn btn-info">Visualizar Categoría</a>
                    <a href="<?= base_url() . "/visualizarMarca"; ?>" class="btn btn-secondary">Visualizar Marca</a>                                                                                                                  
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">

                                <table id="datatable" class="table table-striped table-bordered text-center" style="width:100%">
                                    <thead class="text-center">
                                        <tr class="text-center">
                                            <th>Id</th>
                                            <th>Producto</th>
                                            <th>Categoría</th>
                                            <th>Descripción</th>
                                            <th>Stock</th>
                                            <th>Precio por Unidad</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($Resultado as $key => $value):
                                                ?>
                                                <tr>  
                                                    <td> <?= $value["idproducto"] ?>  </td>
                                                    <td> <?= $value["producto"] ?> </td>
                                                    <td> <?= $value["categoria"] ?> </td>
                                                    <td> <?= $value["descripcionproducto"] ?> </td>
                                                    <td> <?= $value["stock"] ?> </td>
                                                    <td> <?= $value["preciounidad"] ?> </td>
                                                    <td class="text-center row">
                                                        <div class="col-12 col-md-6 col-sm-10 col-lg-4 px-1 mx-auto">
                                                          <a href="<?= base_url() . "/visualizarProducto/getupdatever/" . $value["idproducto"]; ?>" class="btn btn-secondary  btn-sm col-12" ><i class="fa fa-pencil tema">Ver</i></a>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-sm-10 col-lg-4 px-1 mx-auto">
                                                          <a href="<?= base_url() . "/visualizarProducto/getupdate/" . $value["idproducto"]; ?>" class="btn btn-info btn-sm col-12 mr-5 " ><i class="fa fa-pencil tema pr-3">Modificar</i></a>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-sm-10 col-lg-4 px-1  mx-auto">
                                                          <a onclick="return alerta();" href="<?= base_url() . "/VisualizarProducto/delete/" . $value['idproducto']; ?>"   class="btn btn-danger btn-sm col-12"><i class="fa fa-trash-o tema">Eliminar</i></a>
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
        var m = confirm("¿Está seguro que desea eliminar este producto?");
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
