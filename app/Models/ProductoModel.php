<?php 

namespace App\Models;
use CodeIgniter\Model;

class ProductoModel extends Model{

	protected $table = 'producto';
	protected $primaryKey = 'idproducto';
	protected $returnType = 'array';
	protected $allowedFields = ['idcategoria','producto','idmarca', 'stock', 'preciounidad',
                                'descripcionproducto','rutafoto','estadoproducto', 'idlinea'];

    public function traerProductos()
    {
        return $this->db->table("producto p")
                ->where("p.estadoproducto", 1)
                ->join("categoria c", "p.idcategoria = c.idcategoria")
                ->join("marca m", "m.idmarca = p.idmarca")
                ->join("linea l", "l.idlinea = p.idlinea")
                ->get()->getResultArray();
    }

    public function traerProductoPorId($id)
    {
        return $this->db->table("producto p")
                ->where("p.estadoproducto", 1)
                ->where("p.idproducto", $id)                
                ->join("categoria c", "p.idcategoria = c.idcategoria")
                ->join("marca m", "m.idmarca = p.idmarca")
                ->join("linea l", "l.idlinea = p.idlinea")
                ->get()->getResultArray();
    }
    
}
