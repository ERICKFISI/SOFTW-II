<script src="<?= base_url().'/public/js/ajax.js'; ?>" type="text/javascript"></script>

<script>
 
 function marca(respuesta, cadena)
 {
     let marcas = JSON.parse(respuesta);
     for (let i in marcas)
     {
	 if (marcas[i].marca === cadena)
	 {
	     alert("Este nombre de marca ya existe");
	     document.getElementById("marca").value = "";
	 }
     }
 }

 function verificarMarca(entrada)
 {
     ajax_get("../marca/traerMarcas", entrada.value, marca);
 }
 
</script>


<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Registrar Marca</h3>
        </div>
    </div>
    <div class="col-md-3-6 ">
        <div class="x_panel">

            <div class="x_content">
                <br />
                <form class="form-horizontal form-label-left h6" action="../marca/create" method="POST">

                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Nombre de la marca
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" id="marca" value="" onchange="verificarMarca(this)" name="marca" required>
                        </div>
                    </div>


                    <br>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <a href= "<?= base_url() . "/VisualizarMarca" ?>" class="btn btn-primary">Cancelar</a>
                        </div>
                    </div>

                </form>
            </div>
        </div> 
    </div> 
</div>
