
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Visualizar venta</h3>
        </div>
    </div>
    <div class="col-md-3-6 ">
        <div class="x_panel">
            <div class="x_content">
                <br />
                <form class="form-horizontal form-label-left h6" action="../ventas/crear" method="POST">
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Cliente
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <select class="form-control" id="idcliente" name="idcliente" readonly>
                                <option value=""><?= $venta["razonsocial"]; ?></option>
                            </select>
                        </div>
                    </div>

			<div class="form-group row ">
                            <label class="control-label col-md-3 col-sm-3 ">Direcci&oacute;n Cliente
                            </label>
                            <div class="col-md-9 col-sm-9 ">
				<input type="text" class="form-control"  value="<?= $venta['direccioncliente']; ?>" id="direccioncliente" name="direccioncliente" readonly>
                            </div>
			</div>           

                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Usuario
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <select class="form-control" id="idusuario" name="idusuario" readonly>
                                <option value=""><?= $venta["nombre"] ?></option>
                            </select>
                        </div>
		    </div>

                    <div class="form-group row ">			
                        <label class="control-label col-md-3 col-sm-3 ">Tipo Comprobante
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <select class="form-control" id="idcomprobante" name="idcomprobante" readonly>
                                <option value=""><?= $venta["comprobante"]; ?></option>
                            </select>
                        </div>
		    </div>
		    
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Fecha de venta
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="date" class="form-control"  name="fechaventa" value="<?= $venta['fechaventa']; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Total Soles Venta S/.
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control"  id="totalventa" name="totalventa" value="<?= $venta['totalventa']; ?>" readonly>
                        </div>
                    </div>
                    <div class="ln_solid bg-red"></div>
                    <table class="table table-bordered" id="tabla" style="text-align: center;">
                        <thead class="table-danger">
                            <tr>
                                <th>Cantidad</th>
                                <th>Producto</th>
                                <th>Precio Unidad</th>
                                <th>Sub Total</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
			    <?php foreach ($detalles as $detalle): ?>
				<tr>
				    <td> <?= $detalle["cantidadventa"]; ?></td>
				    <td> <?= $detalle["producto"]; ?></td>
				    <td> <?= $detalle["preciounidad"]; ?></td>
				    <td> <?= number_format($detalle["preciounidad"] * $detalle["cantidadventa"], 2); ?></td>
				    <td> <input disabled class='btn btn-outline-danger'  type='button' value='Quitar'></td>
				</tr>
			    <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" style="text-align: right;"><strong>Total : </strong></td>
				<td id="total"> <!-- strong -->
				    <strong>
					<?$venta["totalventa"]; ?>
				    </strong>
                                </td>
				<tr>
                        </tfoot>
                    </table>

		    <div class="form-group" id="productos">

		    </div>
		    
                    <div class="form-group row">
                        <center class="col-md-12 col-sm-12  offset-md-12">
                            <a href="<?php echo base_url() . '/ventas' ?>" class="btn btn-primary">Volver</a>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div> 
</div>
