<div class="">
    <div class="title">
        <div class="col-12">
            <h3>Visualizar Compras</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel ">
                <div class="x_title">
                    <a href="<?= base_url() . "/compras/registrar"; ?>" class="btn btn-success">Registrar Compra</a>
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
					    <th>Direcci&oacute;n</th>
                                            <th>Comprobante</th>
                                            <th>Fecha</th>
					    <th>Total</th>
					    <th>Estado</th>
                                            <th colspan="2">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($compras as $llave => $valor): ?>
					    <tr>
						<td> <?= $valor["idcompra"]; ?></td>
						<td> <?= $valor["razonsocial"]; ?></td>
						<td> <?= $valor["direccioncompra"]; ?></td>
						<td> <?= $valor["comprobante"]; ?></td>
						<td> <?= $valor["fechacompra"]; ?></td>
						<td> <?= $valor["totalcompra"]; ?></td>
						<td>
						    <?php
						    if ($valor["estadocompra"] == 1) {
						    ?>
							<span class="badge badge-primary">Activo</span>
						    <?php } else {?>
							<span class="badge badge-danger">Anulado</span>
						    <?php } ?>
						</td>
						<td>
						    <a href="<?= base_url().'/compras/ver/'.$valor["idcompra"] ?>" class="btn btn-secondary"><i class="fa fa-eye"></i> Ver</a>
						</td>
						<td>
						    <a href="<?= base_url().'/compras/eliminar/'.$valor["idcompra"] ?>" onclick="return alerta()" class="btn btn-danger"><i class="fa fa-trash-o"></i> Eliminar</a>
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
     var m = confirm("¿Está seguro que desea anular esta compra?");
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
