<div class="">
    <div class="title">
        <div class="col-12">
            <h3>Visualizar Serie de Comprobante</small></h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel ">
                <div class="x_title">
                    <a href="<?= base_url() . "/SerieComprobante/form"; ?>" class="btn btn-success">Registrar Serie de Comprobante</a>
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
                                            <th>Tipo de Comprobante</th>
                                            <th>Serie</th>
                                            <th>Correlativo</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($seriecomprobantes as $key => $value):
                                                ?>
                                                <tr>  
                                                    <td class="text-center"> <?= $value["idseriecorrelativo"] ?>  </td>
                                                    <td class="text-center"> <?= $value["comprobante"] ?>  </td>
                                                    <td class="text-center"> <?= $value["seriesc"] ?>  </td>
                                                    <td class="text-center"> <?= $value["correlativosc"] ?> </td>
                                                    <td class="text-center row">
                                                            <div class="col-12 col-md-8 col-sm-8 col-lg-6 px-0 mx-auto">
                                                                <a href="<?= base_url() . "/SerieComprobante/show/" . $value["idseriecorrelativo"]; ?>" class="btn btn-info btn-sm col-12" ><i class="fa fa-pencil tema">Modificar</i></a>
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
<style type="text/css">
    .tema::before
    {
        margin-right: 5px !important;
    }
</style>
<script type="text/javascript">
    function alerta()
    {
        var m = confirm("¿Está seguro que desea eliminar esta serie de comprobante?");
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
