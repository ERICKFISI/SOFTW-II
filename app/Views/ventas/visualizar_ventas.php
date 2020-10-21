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

                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead class="text-center">
                                        <tr class="text-center">
                                            <th>Id</th>
                                            <th>Cliente</th>
					    <th>Direccion</th>
                                            <th>Usuario</th>
                                            <th>Comprobante</th>
                                            <th>Fecha</th>
					    <th>Total</th>
					    <th>Estado</th>
                                            <th colspan="2">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($ventas as $llave => $valor): ?>
					    <tr>
						<td> <?= $valor["idventa"]; ?></td>
						<td> <?= $valor["razonsocial"]; ?></td>
						<td> <?= $valor["direccioncliente"]; ?></td>
						<td> <?= $valor["nombre"]; ?></td>
						<td> <?= $valor["comprobante"]; ?></td>
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
						<td>
						    <a href="<?= base_url().'/ventas/ver/'.$valor["idventa"] ?>" class="btn btn-secondary"><i class="fa fa-eye"></i> Ver</a>
						</td>
						<td>
						    <a href="<?= base_url().'/ventas/eliminar/'.$valor["idventa"] ?>" onclick="return alerta()" class="btn btn-danger"><i class="fa fa-trash-o"></i> Eliminar</a>
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
