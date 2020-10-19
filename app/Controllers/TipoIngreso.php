<?php 

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\TipoIngresoModel;


class TipoIngreso extends Controller{

	public function index()
	{
		$tipoingreso_model = new TipoINgresoModel();
		$tipoingreso = $tipoingreso_model->where('estadotipoingreso',1)->findAll();
		$data;
		if(!is_null($tipoingreso)){
			$data = $tipoingreso;
			}
			else{
				$data = array('No se encontro el tipoingreso');
			}
			return $data;
	}

	public function create(){
		
		if(isset($_POST['tipoingreso'])){   #RECEPCION FORULARIO

            $tipoingreso_model = new TipoIngresoModel();

            $tipoingreso = $tipoingreso_model->where(["estadotipoingreso" => 1, "tipoingreso" => $_POST["tipoingreso"]])->findAll();
			$existe_tipoingreso = (empty($tipoingreso) ? 1 : 0);

			$data = array('tipoingreso' => $_POST['tipoingreso']);
				
			$mensaje;

			if($existe_tipoingreso == 0){   
				$mensaje = 'Esta tipoingreso ya existe';
				return $mensaje; die;
			}

            $tipoingreso = $tipoingreso_model->insert($data);
            $mensaje = 'Marca añadido';
			
			return redirect()->to( base_url().'/index.php/VisualizarIngreso'); 

		}#fin IF

		else{
			$data = 'ERROR-404';
			return redirect()->to( base_url().'/index.php/VisualizarIngreso'); 

		}#fin ELSE
	} 
			
}#fin CLASS
