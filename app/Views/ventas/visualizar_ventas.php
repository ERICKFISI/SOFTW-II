<div class="">
    <div class="title">
        <div class="col-12">
            <h3>Visualizar Ventas</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel ">
                <div class="x_title">
                    <a href="<?= base_url() . "/ventas/registrar"; ?>" class="btn btn-success">Registrar Venta</a>
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
					    <th>Comprobante</th>
                        <th>N° Comprobante</th>
                                            <th>Cliente</th>
					    <th>Dirección</th>
                                            <th>Usuario</th>
                                            <th>Fecha</th>
					    <th>Total</th>
					    <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($ventas as $llave => $valor): ?>
					    <tr>
						<td> <?= $valor["idventa"]; ?></td>
                        <td> <?= $valor["comprobante"]; ?></td>
						<td> <?= $valor["seriesc"]."-".$valor[ "serie" ]; ?></td>
						<td> <?= $valor["razonsocial"]; ?></td>
						<td> <?= $valor["direccioncliente"]; ?></td>
						<td> <?= $valor["nombre"]; ?></td>	
						<td> <?= $valor["fechaventa"]; ?></td>
						<td> <?= $valor["totalventa"]; ?></td>
						<td>
						    <?php
						    if ($valor["estadoventa"] == 1) {
						    ?>
							<span class="badge badge-primary">Activo</span>
						    <?php } else {?>
							<span class="badge badge-danger">Anulado</span>
						    <?php } ?>
						</td>
                        <td class="text-center row">
                        <?php
                            if ($valor["estadoventa"] == 1) {
                            ?>
                            <div class="col-lg-10 col-md-10 mx-auto px-0">
                            <a href="<?= base_url().'/ventas/ver/'.$valor["idventa"] ?>" class="btn btn-secondary btn-sm mx-auto col-12"><i class="fa fa-eye tema">Ver</i></a></div>
                            <div class="col-lg-10 col-md-10 mx-auto px-0" >
                            <a href="<?= base_url().'/ventas/eliminar/'.$valor["idventa"] ?>" onclick="return alerta()" class="btn btn-danger btn-sm mx-auto col-12"><i class="fa fa-trash-o tema">Eliminar</i></a></div>
                            <?php } else {?>
                            <div class="col-lg-10 col-md-10 mx-auto px-0">
                            <a href="<?= base_url().'/ventas/ver/'.$valor["idventa"] ?>" class="btn btn-secondary btn-sm mx-auto col-12"><i class="fa fa-eye tema">Ver</i></a></div>
                            <?php } ?>
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
        var m = confirm("¿Está seguro que desea anular esta venta?");
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
