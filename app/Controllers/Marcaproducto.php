<?php 

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\MarcaModel;

class Marcaproducto extends BaseController{

	public function index(){
		$marca_model = new MarcaModel();
		$marcas = $marca_model->where('estado',1)->findAll();
		$data;
		if(!is_null($marcas)){
			$data = $marcas;
			}
			else{
				$data = array('No se encontraron marcas');
			}
			return $data;
		}

    public function traerPorId($id)
    {
        $marca_model = new MarcaModel();
		$marca = $marca_model->where('estado', 1)->find($id);
		$data;
		if(!is_null($marca)){
			$data = $marca;
			}
			else{
				$data = array('No se encontro la marca');
			}
			return $data;
    }


		public function validarMarca($id_marca){
			$marca_model = new MarcaModel();
			$marca = $marca_model->where('estado',1)->find($id_marca);
			$data;
			if(!is_null($marca)){
				$data = 1;
			}
			else{
				$data = 0;
			}
			return $data;
	}

}

