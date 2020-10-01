<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Registrar Salida de Almacén</h3>
        </div>
    </div>
    <div class="col-md-3-6 ">
        <div class="x_panel">
            <div class="x_content">
                <br />
                <form class="form-horizontal form-label-left h6" action="salida/create" method="POST">
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Tipo Salida
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <select class="form-control" id="idtiposalida" name="idtiposalida">
                                <option value="">Seleccione ...</option>
                                <?php
                                $html = '';
                                foreach ($tiposalida as $key => $value) {
                                    $html .= '<option value="'.$value['idtiposalida'].'">'.$value['tiposalida'].'</option>';
                                }
                                echo $html;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Fecha Salida
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="datetime-local" class="form-control"  name="fechasalida" required>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Total Soles Salida
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control"  id="totalsalida" name="totalsalida" required>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Descripcion Salida
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control"  id="descripcionsalida" name="descripcionsalida" required>
                        </div>
                    </div>
                    <br>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                            <a href="<?php echo base_url() . '/salida' ?>" class="btn btn-primary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div> 
    </div> 
</div>
