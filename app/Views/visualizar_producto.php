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
                                                    <td>
                                                      <div class="col-12 mx-auto px-0"> 
                                                        <div class="col-12 mx-auto text-align px-0">
                                                          <a href="<?= base_url() . "/visualizarProducto/getupdatever/" . $value["idproducto"]; ?>" class="btn btn-secondary  btn-sm mx-auto col-12" ><i class="fa fa-pencil"></i>Ver</a>
                                                        </div>
                                                        <div class="col-12 mx-auto text-align px-0">
                                                          <a href="<?= base_url() . "/visualizarProducto/getupdate/" . $value["idproducto"]; ?>" class="btn btn-info btn-sm mx-auto col-12" ><i class="fa fa-pencil"></i>Modificar</a>
                                                        </div>
                                                        <div class="col-12 mx-auto text-align px-0" >
                                                          <a onclick="return alerta();" href="<?= base_url() . "/VisualizarProducto/delete/" . $value['idproducto']; ?>"   class="btn btn-danger btn-sm mx-auto col-12"><i class="fa fa-trash-o"></i>Eliminar</a>
                                                        </div>
                                                    </div></td> 
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
