        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
  
                </ul>
              </nav>
            </div>
          </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="title">
              <div class="col-12">
                <h3>Visualizar Perfil</small></h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel ">
                  <div class="x_title">
                    <a href="<?= base_url()."/registrarperfil";  ?>" class="btn btn-success">Registrar Perfil</a>
                    <a href="<?= base_url()."/visualizarusuario";  ?>" class="btn btn-info">Visualizar Usuario</a>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">

                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Perfil</th>
                          <th>Permisos</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php  foreach ( $Resultado as $key => $value ):
                          //if ($value["estadoperfil"] == 1 && $value["estadousuario"] == 1) {
                          ?>
                        <tr>  
                        <td> <?= $value[ "idperfil" ]   ?>  </td>
                        <td> <?= $value[ "nombreperfil" ] ?> </td>
                        <td> <?php foreach ($Resultado2 as $key2 => $value2 ) 
                        { 
                          if ( $value2["idperfil2"] == $value["idperfil"] ) {?> 
                          <li> <?= $value2["nombremodulo"];?> </li> <?php }} ?>
                      </td>
                        <td>
                          <div class="col-12 mx-auto px-0"> 
                            <div class="col-12 mx-auto text-align px-0">
                            <a href="<?= base_url()."/visualizarperfil/getupdate/".$value["idperfil"];?>" class="btn btn-info btn-sm mx-auto col-12" ><i class="fa fa-pencil"></i>Modificar</a></div>
                            <div class="col-12 mx-auto text-align px-0" >
                            <a href="<?= base_url()."/visualizarperfil/delete/".$value['idperfil'];?>"  onclick="return confirm('¿Está seguro que desea eliminar este perfil?');" class="btn btn-danger btn-sm mx-auto col-12"><i class="fa fa-trash-o"></i>Eliminar</a>
                            </div>
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