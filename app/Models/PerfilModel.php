<?php 

namespace App\Models;
use CodeIgniter\Model;

class PerfilModel extends Model{

	protected $table = 'perfil';
	protected $primaryKey = 'idperfil';
	protected $returnType = 'array';
	protected $allowedFields = ['nombre','estado'];

}