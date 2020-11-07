<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ModeloSerieComprobante;
class Test extends BaseController
{
	public function index()
	{
		$mseriecorrelativo = new ModeloSerieComprobante();
                   $datos = "0";
                   $datos = $datos + 1;
                   $data = $mseriecorrelativo->find( "1" );
                   switch( strlen($datos) )
                   {
                   		case '1':
                   			$datos = "000".$datos;
                   			break;
                   		case '2':
                   			$datos = "00".$datos;
                   			break;
                   		case '3':
                   			$datos = "0".$datos;
                   			break;
                   		default;
                   }
                   $correlativo = array(
                   	'correlativosc' => $datos
                   );
                  $updatecorrelativo = $mseriecorrelativo->update( $data[ 'idseriecorrelativo' ], $correlativo  );
	}	
}