<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Controllers\perfil;

class VisualizarVenta extends BaseController
{
	public function index()
	{	
		$db = \Config\Database::connect();
		$model = $db -> query( 'SELECT * FROM venta AS v WHERE v.estadoventa = 1' );
		$datos[ 'venta' ] = $model -> getResultArray();
		echo $this->use_layout('visualizar_venta', $datos);
	}
	public function show( $id )
	{

	}

	public function getupdate( $id )
	{

	}

	public function update( $id )
	{

	}

	public function delete( $id )
	{
		
	}
}