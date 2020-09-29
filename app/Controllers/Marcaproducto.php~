<?php 

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\CategoriaModel;

class Categoriaproducto extends BaseController{

	public function index(){
		$categoria_model = new CategoriaModel();
		$categorias = $categoria_model->where('estadocategoria',1)->findAll();
		$data;
		if(!is_null($categorias)){
			$data = $categorias;
			}
			else{
				$data = array('No se encontraron categorias');
			}
			return $data;
		}

		public function validarCategoria($id_categoria){
			$categoria_model = new CategoriaModel();
			$categoria = $categoria_model->where('estadocategoria',1)->find($id_categoria);
			$data;
			if(!is_null($categoria)){
				$data = 1;
			}
			else{
				$data = 0;
			}
			return $data;
	}

}

