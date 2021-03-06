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
                    <a href="<?= base_url() . "/home/registrarproveedor"; ?>" class="btn btn-success">Registrar Proveedor</a>                                                                                                                
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
                                            <th>Proveedor</th>
                                            <th>Tipo de Documento</th>
                                            <th>Documento</th>
                                            <th>Dirección</th>
                                            <th>Correo Elec.</th>
                                            <th>Teléfono    </th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($Resultado as $key => $value):
                                                ?>
                                                <tr>  
                                                    <td> <?= $value["idproveedor"] ?>  </td>
                                                    <td> <?= $value["razonsocial"] ?> </td>
                                                    <td> <?= $value["tipodocumento"] ?> </td>
                                                    <td> <?= $value["documento"] ?> </td>
                                                    <td> <?= $value["direccion"] ?> </td>
                                                    <td> <?= $value["email"] ?> </td>
                                                    <td> <?= $value["telefono_cel"] ?> </td>
                                                    <td class="px-0 text-center">
                                                        <div class="col-12 mx-auto text-align py-0">
                                                          <a href="<?= base_url() . "/VisualizarProveedor/getupdate/" . $value["idproveedor"]; ?>" class="btn btn-info btn-sm mx-auto col-12" ><i class="fa fa-pencil tema">Modificar</i></a>
                                                        </div>
                                                        <div class="col-12 mx-auto text-align py-0">
                                                          <a onclick="return alerta();" href="<?= base_url() . "/VisualizarProveedor/delete/" . $value['idproveedor']; ?>"   class="btn btn-danger btn-sm mx-auto col-12"><i class="fa fa-trash-o tema">Eliminar</i></a>
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
        var m = confirm("¿Está seguro que desea eliminar este proveedor?");
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
