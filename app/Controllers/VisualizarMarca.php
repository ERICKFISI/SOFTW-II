<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Controllers\perfil;
use App\Models\MarcaModel;

class VisualizarMarca extends BaseController
{
		public function index()
		{	
			$model = new MarcaModel();
			$datos ['marca'] = $model -> where( 'estado', 1 ) -> findAll();
			 echo $this->use_layout('visualizar_marca', $datos);
		}

		public function show( $id )
		{
			if (is_numeric($id))
			{
				$model = new MarcaModel();
				$datos ['marca'] = $model -> where( 'estado', 1 ) -> find( $id );
				if(empty($datos))
				{
					
				}
			}
			else
			{
				echo "Error";
			}
		}
    
    public function getupdate($id) 
    {
        helper('form');
        $productos = new MarcaModel();
        
        $data['marca'] = $productos->where('estado', 1)->find($id);
        echo $this->use_layout('modificar_marca', $data);
    }

    public function update($id) {
        $request = \Config\Services::request();
        $model = new MarcaModel();
        $datos = [
            'marca' => $request->getPost('marca'),
        ];
        $model->update($id, $datos);
        return redirect()->to(base_url() . '/index.php/VisualizarMarca');
    }

    public function delete($id) {
        $db = \Config\Database::connect();
        $model2 = $db->query("UPDATE marca SET estado = 0 WHERE idmarca = $id AND estado = 1");
        return redirect()->to(base_url() . '/index.php/VisualizarMarca');
    }

}
