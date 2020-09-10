<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ModeloPermiso;
use App\Models\ModeloModulo;
use App\Models\ModeloPerfil;

class VisualizarPerfil extends BaseController
{
	public function index()
	{
		$db = \Config\Database::connect();	
		$model = $db -> query('SELECT perf.idperfil, perf.nombre AS nombreperfil FROM perfil AS perf INNER JOIN permiso AS perm ON perf.idperfil = perm.idperfil INNER JOIN modulo AS m ON m.idmodulo = perm.idmodulo WHERE perm.estado = 1 AND perf.estado = 1 AND m.estado = 1 GROUP BY perf.idperfil, nombreperfil');
		$model2 = $db -> query('SELECT perf.idperfil AS idperfil2 ,  m.nombre AS nombremodulo FROM perfil AS perf INNER JOIN permiso AS perm ON perf.idperfil = perm.idperfil INNER JOIN modulo AS m ON m.idmodulo = perm.idmodulo WHERE perm.estado = 1 AND perf.estado = 1 AND m.estado = 1');
		$datos["Resultado"] = $model -> getResultArray();
		$datos["Resultado2"] = $model2 -> getResultArray();
                echo $this->use_layout('visualizar_perfil',$datos);
	}
	public function getupdate( $id )
	{
		$data = array(
        'menu' => $this->Menu()
        );
        echo view('header');
        echo view('menu',$data);

        $perfiles = new ModeloPerfil();
        $permisos = new ModeloPermiso();
        $modulos = new ModeloModulo();
        $data['permisos'] = $permisos->where( ['idperfil' => $id ,'estado' => 1])->findAll();
        $data['perfiles'] = $perfiles -> where( 'estado', 1 ) -> find( $id );
        $data['modulos'] = $modulos -> where( 'estado', 1 ) -> findAll();
        echo view('modificar_perfil', $data);
        echo view('footer');
	}
	public function update( $id )
	{
		$bd = \Config\Database::connect();
		$perfil = new ModeloPerfil();
		$perfil -> update( [$id, 'nombreperfil' => $_POST['nombreperfil']] );
		foreach ($_POST['checks'] as $permisos) {
		$permiso = new ModeloPermiso();
		$permiso = $permiso-> where( ['idperfil' => $id , 'idmodulo' => $permisos] );
		if ( is_null($permiso) )
		{
			$permiso = $bd -> query( 'INSERT INTO (idperfil, idmodulo) VALUES( $id, $permisos )' );
		}
		else
		{
			$permiso = $bd -> query( 'UPDATE permiso SET estado = 1 WHERE idmodulo = $permisos AND idperfil = $id' );
		}
		}
		return redirect()->to(base_url() . '/index.php/VisualizarPerfil');
		 
		//falta considerar de que pasa si no se creo ese permiso
	}
	public function delete( $id )
	{	
		$db = \Config\Database::connect();	
		$model2 = $db -> query("UPDATE perfil SET estado = 0 WHERE idperfil = $id AND estado = 1");
 		return redirect()->to(base_url() . '/index.php/VisualizarPerfil');
	}
}