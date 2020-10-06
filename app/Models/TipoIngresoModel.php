<?php 

namespace App\Models;
use CodeIgniter\Model;

class TipoIngresoModel extends Model{

	protected $table = 'tipoingreso';
	protected $primaryKey = 'idtipoingreso';
	protected $returnType = 'array';
	protected $allowedFields = ['tipoingreso','estadotipoingreso'];

}