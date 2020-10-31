<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Controllers\perfil;
use App\Models\ModeloPermiso;

class VisualizarSalida extends BaseController
{
	public function index()
	{	
		$db = \Config\Database::connect();
		$model = $db -> query( 'SELECT s.idsalida, s.idtiposalida, s.idcomprobantesalida, s.fechasalida, s.totalsalida, s.descripcionsalida FROM salida AS s WHERE s.estadosalida = 1' );
		$datos[ 'salida' ] = $model -> getResultArray();
		echo $this->use_layout('visualizar_salida', $datos);
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