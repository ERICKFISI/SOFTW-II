<?php 

namespace App\Models;
use CodeIgniter\Model;

class MarcaModel extends Model{

	protected $table = 'marca';
	protected $primaryKey = 'idmarca';
	protected $returnType = 'array';
	protected $allowedFields = ['marca','estado'];

    public function traerMarcas()
    {
        return $this->db->table("marca m")
                ->where("m.estado", 1)
                ->get()->getResultArray();
    }
}
