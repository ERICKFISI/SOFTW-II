<?php 

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\MarcaModel;
use App\Models\ModeloPermiso;


class Marca extends Controller{

	/*public function index(){

	}*/

	public function create(){
		
		if(isset($_POST['marca'])){   #RECEPCION FORULARIO

            $marca_model = new MarcaModel();

            $marca = $marca_model->where(["estado" => 1, "marca" => $_POST["marca"]])->findAll();
			$existe_marca = (empty($marca) ? 1 : 0);

			$data = array('marca' => $_POST['marca']);
				
			$mensaje;

			if($existe_marca == 0){   
				$mensaje = 'Esta marca ya existe';
				return $mensaje; die;
			}

            $marca = $marca_model->insert($data);
            $mensaje = 'Marca añadido';
			
			return redirect()->to( base_url().'/index.php/VisualizarMarca'); 

		}#fin IF

		else{
			$data = 'ERROR-404';
			return redirect()->to( base_url().'/index.php/VisualizarMarca'); 

		}#fin ELSE
	} 
			
    public function traerMarcas()
    {
        $modelo = new MarcaModel();

        $marcas = $modelo->traerMarcas();
        return json_encode($marcas, true);
    }


}#fin CLASS
