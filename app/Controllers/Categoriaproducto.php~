<?php 

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\PerfilModel;

class Perfil extends BaseController{

	public function index(){
		$perfil_model = new PerfilModel();
		$perfiles = $perfil_model->where('estado',1)->findAll();
		$data;
		if(!is_null($perfiles)){
			$data = $perfiles;
			}
			else{
				$data = array('No se encontraron perfiles');
			}
			return $data;
		}

		public function validarPerfil($id_perfil){
			$perfil_model = new PerfilModel();
			$perfil = $perfil_model->where('estado',1)->find($id_perfil);
			$data;
			if(!is_null($perfil)){
				$data = 1;
			}
			else{
				$data = 0;
			}

			return $data;
		}

	}

