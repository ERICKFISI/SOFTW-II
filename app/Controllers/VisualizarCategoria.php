<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Controllers\perfil;

class VisualizarCategoria extends BaseController
{
		public function index()
		{	
			$datos["a"] = array(
				'a' => 1
			);
			 echo $this->use_layout('visualizar_categoria', $datos);
		}
}