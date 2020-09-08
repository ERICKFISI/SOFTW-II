<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Controllers\perfil;
use App\Models\UsuarioModel;
class VisualizarUsuario extends BaseController
{
	public function index()
	{
		$db = \Config\Database::connect();	
		$model = $db -> query('SELECT p.nombre AS nombreperfil, u.idusuario, u.nombreusuario, u.nombre, u.dni, u.telefono,u.estado AS estadousuario, p.estado AS estadoperfil FROM perfil AS p INNER JOIN usuario AS u ON p.idperfil = u.idperfil');
		$datos["Resultado"] = $model -> getResultArray();

		echo view( 'header' );
		echo view( 'menu' );
		echo view( 'visualizar_usuario', $datos );
		echo view( 'footer' );
	}
	public function getupdate( $id )
	{
		helper('form');
		echo view('header');
		echo view('menu');

		$perfiles = new perfil();
		$perfiles = $perfiles->index();
		$usuarios = new UsuarioModel();
		$data['usuarios'] = $usuarios -> where( 'estado', 1 ) -> find( $id );
		$data['perfiles'] = $perfiles;
		echo view('modificar_usuario',$data);

		echo view('footer');
	}
	public function update( $id )
	{
		$request = \Config\Services::request();
		$model = new UsuarioModel();
		$datos = [
			'nombreusuario' => $request -> getPost('nombreusuario'),
			'contrasena' => $request -> getPost('contrasena'),
			'nombre' => $request -> getPost('nombre'),
			'dni' => $request -> getPost('dni'),
			'telefono' => $request -> getPost('telefono'),
			'idperfil' => $request -> getPost('idperfil'),
		];
		$model -> update($id, $datos);
		return redirect()->to( base_url().'/index.php/VisualizarUsuario'); 
	}
	public function delete( $id )
	{	
		$db = \Config\Database::connect();	
		$model2 = $db -> query("UPDATE usuario SET estado = 0 WHERE idusuario = $id AND estado = 1");
		$model = $db -> query('SELECT p.nombre AS nombreperfil, u.idusuario, u.nombreusuario, u.nombre, u.dni, u.telefono,u.estado AS estadousuario, p.estado AS estadoperfil FROM perfil AS p INNER JOIN usuario AS u ON p.idperfil = u.idperfil');
		$datos["Resultado"] = $model -> getResultArray();	
		return redirect()->to( base_url().'/index.php/VisualizarUsuario'); 
	}
}