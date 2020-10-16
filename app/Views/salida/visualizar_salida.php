<div class="">
    <div class="title">
        <div class="col-12">
            <h3>Visualizar Salida</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel ">
                <div class="x_title">
                    <a href="<?= base_url() . "/salida/new_"; ?>" class="btn btn-success">Registrar Salida</a>
                    <a href="<?= base_url() . "/ingreso"; ?>" class="btn btn-info">Visualizar Ingreso</a>
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
                                            <th>Tipo de Salida</th>
                                            <th>Fecha</th>
                                            <th>Descripción</th>
                                            <th colspan="3">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $html = "";
                                        foreach ($salida as $key => $value) {
                                            $html .= "<tr>";
                                            $html .= "<td>" . $value['idsalida'] . "</td>";
                                            $html .= "<td>" . $value['tiposalida'] . "</td>";
                                            $html .= "<td>" . $value['fechasalida'] . "</td>";
                                            $html .= "<td>" . $value['descripcionsalida'] . "</td>";
                                            $html .= '<td> ';
                                            $html .= '<a href="' . base_url() . '/salida/ver/' . $value["idsalida"] . '" class="btn btn-secondary btn-sm mx-auto col-12" ><i class="fa fa-pencil"></i>Ver</a>';
                                            $html .= '</td> ';
                                            $html .= '<td> ';					    
                                            $html .= '<a href="' . base_url() . '/salida/edit/' . $value["idsalida"] . '" class="btn btn-info btn-sm mx-auto col-12" ><i class="fa fa-pencil"></i>Modificar</a>';
                                            $html .= '</td> ';
                                            $html .= '<td> ';					    
                                            $html .= '<a onclick="return alerta();" href="'.base_url() . '/salida/delete/' . $value['idsalida'].'"   class="btn btn-danger btn-sm mx-auto col-12"><i class="fa fa-trash-o"></i>Eliminar</a>';
                                            $html .= "</td>";
                                            $html .= "</tr>";
                                        }
                                        echo $html;
                                        ?>

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
        var m = confirm("¿Está seguro que desea eliminar esta salida?");
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
