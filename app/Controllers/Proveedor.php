<?php 

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ProductoModel;
use App\Models\TipoDocumentoModel;


class Proveedor extends Controller{

	/*public function index(){

	}*/

	public function create(){
            		
           if ($_POST['idtipodocumento']==1) {
           	 $razon='nombrecomercial';
           }else{
           	$razon='razonsocial';
           }

			$data = array($razon => $_POST['proveedor'], 
                          'idtipodocumento' => $_POST['idtipodocumento'],
                          'documento' => $_POST['documento'],
                          'direccion' => $_POST['direccion'],
                          'email' => $_POST['email'],
                          'telefono_cel' => $_POST['telefono_cel'],
                          'estadoproveedor' => 1);

            
            
			$mensaje;

		

			$proveedor_model = new ProveedorModel();
            
            $proveedor = $proveedor_model->insert($data);
            $mensaje = 'Proveedor añadido';
			
			return redirect()->to( base_url().'/index.php/VisualizarProveedor'); 

	} 

	private function contar($input,$max_length){
		$length = strlen($input);
		$data;

		if($length != $max_length){
			$data = array('valor' => false, 'mensaje' => ' debe tener un tamaño de '.$max_length.		  ' caracteres');
		}
		else{
			$data = array('valor' => true);
		}
		return $data;
	}
			
}#fin CLASS
