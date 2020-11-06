
<div class="title">
    <div class="col-12">
        <h3>Visualizar Cliente</small></h3>
    </div>
</div>

<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel ">
            <div class="x_title">
                <a href="<?= base_url()."/Clientes/form";  ?>" class="btn btn-success">Registrar Cliente</a>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">

			    <table id="datatable" class="table table-striped table-bordered text-center" style="width:100%">
				<thead>
				    <tr>
					<th>Id</th>
					<th>Razón Social o Nombre</th>
					<th>Tipo de Documento</th>
                    <th>Documento</th>
                    <th>Dirección</th>
                    <th>Correo Elec.</th>
                    <th>Teléfono</th>
					<th>Acciones</th>
				    </tr>
				</thead>
				<tbody>
				    <?php  foreach ( $clientes as $cliente ):
				    //if ($value["estadoperfil"] == 1 && $value["estadousuario"] == 1) {
				    ?>
					<tr>  
					    <td> <?= $cliente[ "idcliente" ]   ?>  </td>
					    <td> <?= $cliente[ "razonsocial" ] ?> </td>
                        <td> <?= $cliente[ "tipodocumento" ] ?> </td>
                        <td> <?= $cliente[ "documento" ] ?> </td>
                        <td> <?= $cliente[ "direccion" ] ?> </td>
                        <td> <?= $cliente[ "email" ] ?> </td>
                        <td> <?= $cliente[ "telefono_cel" ] ?> </td>
					    <td class="px-0 text-center">
						<div class="col-12 mx-auto text-align py-0">
						    <a href="<?= base_url()."/Clientes/show/".$cliente["idcliente"];?>" class="btn btn-info btn-sm mx-auto col-12 py-1" ><span class="fa fa-pencil tema">Modificar</span></a>
						</div>
                        <div class="col-12 mx-auto text-align py-1" >
                            <a href="<?= base_url()."/Clientes/delete/".$cliente['idcliente'];?>"  onclick="return alerta();" class="btn btn-danger btn-sm mx-auto col-12 py-1" style=""><span class="fa fa-trash tema">Eliminar</span></a>
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
<style type="text/css">
    .tema::before
    {
        margin-right: 5px !important;
    }
</style>

    <!-- /page content -->
    <script type="text/javascript">
     function alerta()
     {
         var m = confirm("¿Está seguro que desea eliminar este cliente?");
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
    <!-- footer content -->
    <footer>
        <div class="pull-right">
        </div>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
</div>
</div>
