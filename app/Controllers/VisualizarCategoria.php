<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Controllers\perfil;
use App\Models\CategoriaModel;

class VisualizarCategoria extends BaseController
{
		public function index()
		{	
			$model = new CategoriaModel();
			$datos ['categoria'] = $model -> where( 'estadocategoria', 1 ) -> findAll();
			 echo $this->use_layout('visualizar_categoria', $datos);
		}
}