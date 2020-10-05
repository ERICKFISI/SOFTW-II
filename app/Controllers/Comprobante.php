<?php 

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ComprobanteModel;


class Comprobante extends Controller{

	public function index()
	{
		$comprobante_model = new ComprobanteModel();
		$comprobante = $comprobante_model->where('estadocomprobante',1)->findAll();
		$data;
		if(!is_null($comprobante)){
			$data = $comprobante;
			}
			else{
				$data = array('No se encontro el comprobante');
			}
			return $data;
	}

	public function create(){
		
		if(isset($_POST['comprobante'])){   #RECEPCION FORULARIO

            $comprobante_model = new ComprobanteModel();

            $comprobante = $comprobante_model->where(["estadocomprobante" => 1, "comprobante" => $_POST["comprobante"]])->findAll();
			$existe_comprobante = (empty($comprobante) ? 1 : 0);

			$data = array('comprobante' => $_POST['comprobante']);
				
			$mensaje;

			if($existe_comprobante == 0){   
				$mensaje = 'Esta comprobante ya existe';
				return $mensaje; die;
			}

            $comprobante = $comprobante_model->insert($data);
            $mensaje = 'comprobante añadido';
			
			return redirect()->to( base_url().'/index.php/VisualizarIngreso'); 

		}#fin IF

		else{
			$data = 'ERROR-404';
			return redirect()->to( base_url().'/index.php/VisualizarIngreso'); 

		}#fin ELSE
	} 
			
}#fin CLASS