<?php 

namespace App\Models;
use CodeIgniter\Model;

class ProveedorModel extends Model{

	protected $table = 'proveedor';
	protected $primaryKey = 'idproveedor';
	protected $returnType = 'array';
	protected $allowedFields = ['idtipodocumento','documento','razonsocial','nombrecomercial','direccion','email','telefono_cel','estadoproveedor'];

    public function traerProveedores()
    {
        return $this->db->table("proveedor p")
                ->where("p.estadoproveedor", 1)
                ->get()->getResultArray();
    }

    public function traerPorId($id)
    {
        return $this->db->table("proveedor p")
                ->where("p.estadoproveedor", 1)
                ->where("p.idproveedor", $id)       
                ->get()->getResultArray();
    }

}
