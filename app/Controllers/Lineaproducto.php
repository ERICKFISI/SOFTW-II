<?php 

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\LineaModel;

class Lineaproducto extends BaseController{

	public function index(){
		$linea_model = new LineaModel();
		$lineas = $linea_model->where('estado',1)->findAll();
		$data;
		if(!is_null($lineas)){
			$data = $lineas;
			}
			else{
				$data = array('No se encontraron lineas');
			}
			return $data;
		}

    public function traerPorId($id)
    {
        $linea_model = new LineaModel();
		$linea = $linea_model->where('estado', 1)->find($id);
		$data;
		if(!is_null($linea)){
			$data = $linea;
			}
			else{
				$data = array('No se encontro la linea');
			}
			return $data;
    }


		public function validarLinea($id_linea){
			$linea_model = new LineaModel();
			$linea = $linea_model->where('estado',1)->find($id_linea);
			$data;
			if(!is_null($linea)){
				$data = 1;
			}
			else{
				$data = 0;
			}
			return $data;
	}

}

