
<script src="<?= base_url().'/public/js/ajax.js'; ?>" type="text/javascript"></script>

<script type="text/javascript">

 function cliente(respuesta, cadena)
 {
     let clientes = JSON.parse(respuesta);
     for (let i in clientes)
     {
	 if (clientes[i].documento === cadena)
	 {
	     alert("Este cliente ya existe");
	     document.getElementById("documento").value = "";
	 }
     }
 }

 function verificarDocumento(entrada)
 {
     ajax_get("traerClientes", entrada.value, cliente);
 }
 
</script>




<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Registrar Cliente</h3>
        </div>
    </div>
    <div class="col-md-3-6 ">
        <div class="x_panel">

            <div class="x_content">
                <br />
                <form class="form-horizontal form-label-left h6" action="create" method="POST">

                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 " for="idtipodocumento" >Tipo de Documento</label>
                        <div class="col-md-9 col-sm-9 ">
                            <select class="form-control" name="idtipodocumento" id="idtipodocumento" required>

                                <?php
                                foreach ($tipodocumentos as $tipodocumento) {?>

                                    <option value="<?= $tipodocumento[ 'idtipodocumento' ] ?>"> <?= $tipodocumento[ 'tipodocumento' ] ?> 
                                    </option> <?php } ?>

                            </select>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 " for="documento" >Documento
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" value="" onchange="verificarDocumento(this)" name="documento" id="documento" maxlength="11" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 " for="razonsocial" >Razón Social o Nombre</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text"  style="text-transform: uppercase;" class="form-control" name="razonsocial" id="razonsocial" required>
                        </div>
                    </div>

                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 " for="direccion" >Dirección </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="direccion" id="direccion" required>
                        </div>
                    </div>

                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 " for="email" >Correo Electrónico</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="email" class="form-control" name="email" id="email" required >
                        </div>
                    </div>

                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 " for="telefono_cel">Teléfono</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="tel" class="form-control" name="telefono_cel" id="telefono_cel" minlength="9" maxlength="9" required >
                        </div>
                    </div>
                    <br>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                            <button type="submit" onclick="return alerta();" class="btn btn-success">Guardar</button>
                            <a href= "<?= base_url() . "/Clientes" ?>" class="btn btn-primary">Cancelar</a>
                        </div>
                    </div>

                </form>
            </div>
        </div> 
    </div> 
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
let dniruc2 = document.getElementById( 'documento' );
dniruc2.addEventListener( 'input', function()
    {
        let dniruc = document.getElementById( 'idtipodocumento' );
       if( dniruc.value == "2" && dniruc2.value.length == "11"  )
       {
        var settings = 
        {
          "url": "https://dniruc.apisperu.com/api/v1/ruc/"+dniruc2.value+"?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Imhhcm9sZGVhZC4yNUBnbWFpbC5jb20ifQ.GJrpE8QNz1yA7IN18u4q6h9nT6sw58SQ36GGV8Q-iOo",
          "method": "GET",
          "timeout": 0,
        };

        $.ajax(settings).done(function (response) {
          let razonsocial = document.getElementById( 'razonsocial' );
          razonsocial.value = response[ 'razonSocial' ];
        });
       }
       else if( dniruc.value == "1" && dniruc2.value.length == "8" )
       {
        var settings = 
        {
          "url": "https://dniruc.apisperu.com/api/v1/dni/"+dniruc2.value+"?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Imhhcm9sZGVhZC4yNUBnbWFpbC5jb20ifQ.GJrpE8QNz1yA7IN18u4q6h9nT6sw58SQ36GGV8Q-iOo",
          "method": "GET",
          "timeout": 0,
        };

        $.ajax(settings).done(function (response) {
          let razonsocial = document.getElementById( 'razonsocial' );
          razonsocial.value = response[ 'nombres' ]+" "+response[ 'apellidoPaterno' ]+" "+ response[ 'apellidoMaterno' ] ;
        });
       }
    } );
</script>
<script type="text/javascript">
    function alerta()
    {
        var m = confirm("¿Está seguro que desea guardar este cliente?");
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
<script type="text/javascript">
    let telefono_cel = document.getElementById( 'telefono_cel' );
    telefono_cel.addEventListener( 'input', function()
        {
            
            if( this.value < 0 )
            {
                this.value = null;
            }
            else if( !Number.isInteger( this.value ) )
            {
                this.value = parseInt(this.value);
                if( this.value == "NaN" )
                {
                    this.value = "";
                }
            }
            else if( isNaN( this.value ) )
            {
                this.value = "";
            }
            else if( this.value == "NaN" )
            {
                this.value = "";
            } 
        } );
    let tpdocumento = document.getElementById( 'idtipodocumento' );
    tpdocumento.addEventListener('change', function()
    {
        let documento1 = document.getElementById( "documento" );
        documento1.value = null;
    } ); 

    let tipodocumento = document.getElementById( 'idtipodocumento' );
             let documento = document.getElementById( 'documento' );
                documento.addEventListener( 'input', function()
                {  
                if( tipodocumento.value == 2 )
                {
                    console.log( tipodocumento.value );
                    if( isNaN( documento.value ) )
                    {
                        documento.value = null;
                    }
                    else if( documento.value.length > 11 )
                    {
                        documento.value = documento.value.substring( 0, 11 );
                    }
                    else if( documento.value < 0 )
                    {
                        documento.value = null;
                    }
                }
                else if( tipodocumento.value == 1 )
                {
                    console.log( tipodocumento.value );
                    if( isNaN( documento.value ) )
                    {
                        documento.value = null;
                    }
                    else if( documento.value.length > 8 )
                    {
                        documento.value = documento.value.substring( 0, 8 );
                    }
                     else if( documento.value < 0 )
                    {
                        documento.value = null;
                    }
                }

                if( documento.value < 0 )
                {
                    documento.value = null;
                }
                else if( !Number.isInteger( documento.value ) )
                {
                    documento.value = parseInt(documento.value);
                    if( documento.value == "NaN" )
                    {
                        documento.value = "";
                    }
                }
                else if( isNaN( documento.value ) )
                {
                    documento.value = "";
                }
                else if( documento.value == "NaN" )
                {
                    documento.value = "";
                } 
                } );
    let razonsocial = document.getElementById( 'razonsocial' );
    razonsocial.addEventListener( 'input', function()
    {
        this.value = this.value.toUpperCase();
    } );
</script>
