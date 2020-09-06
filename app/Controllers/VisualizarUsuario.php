<?php 
namespace App\Controllers;
use CodeIgniter\Controller;

class VisualizarUsuario extends Controller
{
	public function index()
	{
		$db = \Config\Database::connect();	
		$model = $db -> query('SELECT p.nombre AS nombrepefil, u.idusuario, u.nombreusuario, u.nombre, u.dni, u.telefono FROM perfil AS p INNER JOIN usuario AS u ON p.idperfil = u.idperfil');
		$data = $model -> getResult();
		var_dump($data );
		//echo view( 'header' );
		//echo view( 'menu' );
		//echo view( 'visualizar_usuario', $datos );
		//echo view( 'footer' );
	}
}