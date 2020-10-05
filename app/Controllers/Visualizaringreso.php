<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Controllers\perfil;

class VisualizarIngreso extends BaseController
{
	public function index()
	{	
		$db = \Config\Database::connect();
		$model = $db -> query( 'SELECT i.idingreso, i.idtipoingreso, i.idcomprobanteingreso, i.fechaingreso, i.totalingreso, i.descripcioningreso FROM ingreso AS i WHERE i.estadoingreso = 1' );
		$datos[ 'ingreso' ] = $model -> getResultArray();
		echo $this->use_layout('visualizar_ingreso', $datos);
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