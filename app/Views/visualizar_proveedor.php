<div class="">
    <div class="title">
        <div class="col-12">
            <h3>Visualizar Proveedor</small></h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel ">
                <div class="x_title">
                    <a href="<?= base_url() . "/home/registrarproveedor"; ?>" class="btn btn-success">Registrar</a>                                                                                                                
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
                                            <th>Proveedor</th>
                                            <th>Direccion</th>
                                            <th>Num. Documento</th>
                                            <th colspan="3">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($Resultado as $key => $value):
                                                ?>
                                                <tr>  
                                                    <td> <?= $value["idproveedor"] ?>  </td>
                                                    <td> <?= $value["razonsocial"].' '.$value["nombrecomercial"] ?> </td>
                                                    <td> <?= $value["direccion"] ?> </td>
                                                    <td> <?= $value["documento"] ?> </td>
                                                    <td>
                                                        <div class="col-12 mx-auto text-align px-0">
                                                          <a href="<?= base_url() . "/visualizarProveedor/getupdatever/" . $value["idproveedor"]; ?>" class="btn btn-secondary  btn-sm mx-auto col-12" ><i class="fa fa-pencil"></i>Ver</a>
                                                        </div>
						    </td>
						    <td>
                                                        <div class="col-12 mx-auto text-align px-0">
                                                          <a href="<?= base_url() . "/VisualizarProveedor/getupdate/" . $value["idproveedor"]; ?>" class="btn btn-info btn-sm mx-auto col-12" ><i class="fa fa-pencil"></i>Modificar</a>
                                                        </div>
						    </td>
						    <td>
                                                        <div class="col-12 mx-auto text-align px-0" >
                                                          <a onclick="return alerta();" href="<?= base_url() . "/VisualizarProveedor/delete/" . $value['idproveedor']; ?>"   class="btn btn-danger btn-sm mx-auto col-12"><i class="fa fa-trash-o"></i>Eliminar</a>
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
