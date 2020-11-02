<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Registrar Proveedor</h3>
        </div>
    </div>
    <div class="col-md-3-6 ">
        <div class="x_panel">

            <div class="x_content">
                <br />
                <form class="form-horizontal form-label-left h6" action="../Proveedor/create" method="POST">

                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Proveedor
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="proveedor" required>
                        </div>
                    </div>


                    <div class="form-group row">
                      <label class="control-label col-md-3 col-sm-3 ">Documento</label>
                        <div class="col-md-9 col-sm-9 ">
                            <select class="form-control" name="idtipodocumento" id="idtipodocumento" required>

                                <?php
                                foreach ($tipodocumento as $td) {
                                    $nombretipodocumento = $td['tipodocumento'];
                                    $idtipodocumento = $td['idtipodocumento'];
                                    ?>

                                    <option value="<?php echo $idtipodocumento ?>"> <?php echo $nombretipodocumento ?> 
                                    </option> <?php } ?>

                            </select>
                        </div>
                    </div>
 
                


		    <div class="form-group row">
		      <label class="control-label col-md-3 col-sm-3 ">Num. Documento</label>
		      <div class="col-md-9 col-sm-9">
                <input type="number" class="form-control" name="documento" required>			
		      </div>
		    </div>



                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">direccion </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="direccion" id="direccion" required>
                        </div>
                    </div>

                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Email </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="email" class="form-control" name="email" id="email" >
                        </div>
                    </div>

                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Telefono </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="number" class="form-control" name="telefono_cel" id="telefono_cel" >
                        </div>
                    </div>


                    <br>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                             <button type="submit" class="btn btn-success">Guardar</button>
                            <a href= "<?= base_url() . "/VisualizarProveedor" ?>" class="btn btn-primary">Cancelar</a>
                        </div>
                    </div>

                </form>
            </div>
        </div> 
    </div> 
</div>
