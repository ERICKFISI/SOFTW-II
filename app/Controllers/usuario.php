<?php 

namespace App\Controllers;
use App\Models\UsuarioModel;


class Usuario extends Perfil{

	/*public function index(){

	}*/

	public function create(){
		
		if(isset($_POST['idperfil'])){   #RECEPCION FORULARIO
			
			$perfil = new Perfil();

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

			if($existe_perfil == 0){        #perfil no encontrado
				$mensaje = 'Perfil invalido';
			}

			
			/*$nombre_usuario = $_POST['nombreusuario'];
			$usuario = $usuario_model->where('nombreusuario',$nombre_usuario)->find();

			if(is_null($usuario)){*/
				
				#perfil encontrado
				$usuario = $usuario_model->insert($data);
				$mensaje = 'Usuario añadido';
		
			#}
			/*else{
				#nombre de usuario no disponible
				$mensaje = 'Ya existe una cuenta de usuario llamada '.$_POST['nombreusuario'];
			}*/
			
			return redirect()->to( base_url().'/index.php/VisualizarUsuario'); 

		}#fin IF

		else{
			$data = 'ERROR-404';
			return redirect()->to( base_url().'/index.php/VisualizarUsuario'); 

		}#fin ELSE
	} 
			
}#fin CLASS