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

                                <table id="datatable" class="table table-striped table-bordered text-center" style="width:100%">
                                    <thead class="text-center">
                                        <tr class="text-center">
                                            <th>Id</th>
					    <th>N° Comprobante</th>
                                            <th>Proveedor</th>
					    <th>Dirección</th>
                                            <th>Comprobante</th>
                                            <th>Fecha</th>
					    <th>Total</th>
					    <th>Estado</th>
                                            <th >Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($compras as $llave => $valor): ?>
					    <tr>
						<td> <?= $valor["idcompra"]; ?></td>
						<td> <?= $valor["comprobantecompra"]; ?></td>
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
						<td class="text-center row">
                            <?php
                            if ($valor["estadocompra"] == 1) {
                            ?>
                            <div class="col-lg-10 col-md-10 mx-auto px-0">
                              <a href="<?= base_url().'/compras/ver/'.$valor["idcompra"] ?>" class="btn btn-secondary btn-sm mx-auto col-12"><i class="fa fa-eye tema">Ver</i> </a>
                            </div>
                           <div class="col-lg-10 col-md-10 mx-auto px-0">
                              <a href="<?= base_url().'/compras/eliminar/'.$valor["idcompra"] ?>" onclick="return alerta()" class="btn btn-danger btn-sm mx-auto col-12"><i class="fa fa-trash-o tema">Anular</i></a>
                            </div>
                            <?php } else {?>
                             <div class="col-lg-10 col-md-10 mx-auto px-0"> 
                              <a href="<?= base_url().'/compras/ver/'.$valor["idcompra"] ?>" class="btn btn-secondary btn-sm mx-auto col-12"><i class="fa fa-eye tema">Ver</i> </a>
                            </div>
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
<style type="text/css">
    .tema::before
    {
        margin-right: 5px !important;
    }
</style>
