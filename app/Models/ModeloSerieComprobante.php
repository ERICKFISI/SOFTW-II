<?php 

namespace App\Models;
use CodeIgniter\Model;

class ModeloSerieComprobante extends Model
{

	protected $table = 'seriecorrelativo';
	protected $primaryKey = 'idseriecorrelativo';
	protected $returnType = 'array';
	protected $allowedFields = ['seriesc','correlativosc', 'estadoseriecorrelativo', 'idcomprobante'];

	public function traerSerieComprobante()
	{
		return $this -> db -> table( 'seriecorrelativo sc' )
		-> where( 'sc.estadoseriecorrelativo', 1 )
		-> where( 'c.estadocomprobante', 1 )
		-> join(  'comprobante c', 'c.idcomprobante = sc.idcomprobante' )
		-> get() -> getResultArray();
	}

	public function traerSerieComprobantePorId($id)
	{
		return $this -> db -> table( 'seriecorrelativo sc' )
                -> where( 'sc.estadoseriecorrelativo', 1 )
                -> where( 'c.estadocomprobante', 1 )
                -> where( 'sc.idseriecorrelativo', $id )
                -> join(  'comprobante c', 'c.idcomprobante = sc.idcomprobante' )
                -> get() -> getResultArray();
	}

}
