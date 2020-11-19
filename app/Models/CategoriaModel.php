<?php 

namespace App\Models;
use CodeIgniter\Model;

class CategoriaModel extends Model{

	protected $table = 'categoria';
	protected $primaryKey = 'idcategoria';
	protected $returnType = 'array';
	protected $allowedFields = ['categoria','estadocategoria'];

    public function traerCategorias()
    {
        return $this->db->table("categoria c")
                ->where("c.estadocategoria", 1)
                ->get()->getResultArray();
    }
}
