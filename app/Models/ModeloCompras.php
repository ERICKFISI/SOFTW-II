<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeloCompras extends Model
{
    protected $table = "compra";
    protected $primaryKey = 'idcompra';
    protected $returnType = 'array';
    protected $allowedFields = ['idproveedor', 'idcomprobante', 'fechacompra',
                                'direccioncompra', 'totalcompra', 'serie', 'estadocompra'];

    public function traerCompras()
    {
        return $this->db->table("compra v")
                ->join("proveedor c", "v.idproveedor = c.idproveedor")
                ->join("comprobante co", "v.idcomprobante = co.idcomprobante")                
                ->get()->getResultArray();
    }

    public function traerCompraPorId($id)
    {
        return $this->db->table("compra v")
                ->where("v.idcompra", $id)
                ->join("proveedor c", "v.idproveedor = c.idproveedor")
                ->join("comprobante co", "v.idcomprobante = co.idcomprobante")                
                ->get()->getResultArray();
    }

    public function traerDetDeCompra($id)
    {
        return $this->db->table("detcompro v")
                ->where("v.idcompra", $id)
                ->where("v.estadodetcompro", 1)                
                ->join("producto c", "v.idproducto = c.idproducto")
                ->get()->getResultArray();
        
    }

}
