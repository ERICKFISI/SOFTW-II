<?php 

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UsuarioModel;


class Usuario extends Controller{

	public function index(){

	}

	public function create(){
		
		$usuario_model = new UsuarioModel();
		$id_perfil = $_POST['idperfil']; 		
		$existe_perfil = $perfil->validarPerfil($id_perfil);

		$data = array('nombreusuario' => $_POST['nombreusuario'],
					  'nombre' => $_POST['nombre'],
			          'contrasena' => $_POST['contrasena'],
			          'dni' => $_POST['dni'],
			          'telefono' => $_POST['telefono'],
			          'idperfil' => $_POST['idperfil']);
				
			
		$mensaje;
		if($existe_perfil == 0){
			$mensaje = 'Perfil invalido';
		}

		$usuario = $usuario_model->insert($data);
		$mensaje = 'Usuario añadido';
		
		echo $mensaje;

		 return $mensaje;
	} 
			
}