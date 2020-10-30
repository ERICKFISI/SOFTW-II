<?php 

namespace App\Models;
use CodeIgniter\Model;

class TipoDocumentoModel extends Model{

	protected $table = 'tipodocumento';
	protected $primaryKey = 'idtipodocumento';
	protected $returnType = 'array';
	protected $allowedFields = ['tipodocumento','estadotipodocumento'];

}
