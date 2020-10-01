<?php 

namespace App\Models;
use CodeIgniter\Model;

class LineaModel extends Model{

	protected $table = 'linea';
	protected $primaryKey = 'idlinea';
	protected $returnType = 'array';
	protected $allowedFields = ['linea','estado'];

}
