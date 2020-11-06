<?php 

namespace App\Models;
use CodeIgniter\Model;

class ModeloProveedor extends Model{

	protected $table = 'proveedor';
	protected $primaryKey = 'idproveedor';
	protected $returnType = 'array';
	protected $allowedFields = ['idtipodocumento', 'documento', 'razonsocial',
                                'direccion','email','telefono_cel', 'estadoproveedor'];

    public function traerProveedores()
    {
        return $this->db->table("proveedor p")
                ->where("p.estadoproveedor", 1)
                ->join("tipodocumento c", "p.idtipodocumento = c.idtipodocumento")
                ->get()->getResultArray();
    }

    public function traerProveedorPorId($id)
    {
        return $this->db->table("proveedor p")
                ->where("p.estadoproveedor", 1)
                ->where("p.idproveedor", $id)                
                ->join("tipodocumento c", "p.idtipodocumento = c.idtipodocumento")
                ->get()->getResultArray();
    }
    
}
