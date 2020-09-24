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
		helper('form');
        $perfiles = new ModeloPerfil();
        $permisos = new ModeloPermiso();
        $modulos = new ModeloModulo();
        $data['permisos'] = $permisos->where( ['idperfil' => $id ,'estado' => 1])->findAll();
        $data['perfiles'] = $perfiles -> where( 'estado', 1 ) -> find( $id );
        $data['modulos'] = $modulos -> where( 'estado', 1 ) -> findAll();
        echo $this->use_layout('modificar_perfil', $data);
	}
	public function update( $id )
	{
		$request = \Config\Services::request();
		$perfil = new ModeloPerfil();
		$datos = [
            'nombre' => $request->getPost('nombre'),
        ];
		$perfil -> update( $id, $datos);
        $perm = new ModeloPermiso();
		$perm = $perm-> where( 'idperfil', $id ) ->set( 'estado', 0 ) -> update();
		foreach ($request -> getPost('checks') as $permisos) {
		$permiso = new ModeloPermiso();
		$permiso = $permiso -> where( ['idperfil' => $id , 'idmodulo' => $permisos] ) -> find();
		if ( empty($permiso) )

		{
			$permiso = new ModeloPermiso();
			$permiso -> set( 'idperfil', $id ) -> set( 'idmodulo', $permisos ) -> insert();
		}
		else
		{
			$permiso = new ModeloPermiso();
			$permiso -> where( ['idperfil' => $id , 'idmodulo' => $permisos] ) -> set( 'estado', 1 ) ->update();
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