<?php 
namespace App\Controllers;
use CodeIgniter\Controller;

class VisualizarPerfil extends BaseController
{
	public function index()
	{
                    $data = array(
            'menu' => $this->Menu()
        );
		$db = \Config\Database::connect();	
		$model = $db -> query('SELECT perf.idperfil, perf.nombre AS nombreperfil FROM perfil AS perf INNER JOIN permiso AS perm ON perf.idperfil = perm.idperfil INNER JOIN modulo AS m ON m.idmodulo = perm.idmodulo WHERE perm.estado = 1 AND perf.estado = 1 AND m.estado = 1 GROUP BY perf.idperfil, nombreperfil');
		$model2 = $db -> query('SELECT perf.idperfil AS idperfil2 ,  m.nombre AS nombremodulo FROM perfil AS perf INNER JOIN permiso AS perm ON perf.idperfil = perm.idperfil INNER JOIN modulo AS m ON m.idmodulo = perm.idmodulo WHERE perm.estado = 1 AND perf.estado = 1 AND m.estado = 1');
		$datos["Resultado"] = $model -> getResultArray();
		$datos["Resultado2"] = $model2 -> getResultArray();
		echo view( 'header' );
		echo view( 'menu' );
		echo view( 'visualizar_perfil', $datos );
		echo view( 'footer' );
	}
	public function update( $id )
	{

	}
	public function delete( $id )
	{	
		$db = \Config\Database::connect();	
		$model2 = $db -> query("UPDATE usuario SET estado = 0 WHERE idusuario = $id AND estado = 1");
		$model = $db -> query('SELECT p.nombre AS nombreperfil, u.idusuario, u.nombreusuario, u.nombre, u.dni, u.telefono,u.estado AS estadousuario, p.estado AS estadoperfil FROM perfil AS p INNER JOIN usuario AS u ON p.idperfil = u.idperfil');
		$datos["Resultado"] = $model -> getResultArray();
		$estructura = view( 'header' ).view( 'menu' ).view( 'visualizar_usuario', $datos ).view( 'footer' );
		return $estructura;
	}
}