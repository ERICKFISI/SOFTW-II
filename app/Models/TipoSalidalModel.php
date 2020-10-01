<?php 

namespace App\Models;
use CodeIgniter\Model;

class TipoSalidalModel extends Model{

	protected $table = 'tiposalida';
	protected $primaryKey = 'idtiposalida';
	protected $returnType = 'array';
	protected $allowedFields = ['tiposalida','estadotiposalida'];

}