<?php

namespace App\Models;

use CodeIgniter\Model;

class DetalleIngresoProductoModel extends Model {

    protected $table = 'detingpro';
    protected $primaryKey = 'iddetingpro';
    protected $returnType = 'array';
    protected $allowedFields = ['idingreso', 'idproducto','cantidadingreso','preciounidad','estadodetingpro','subtotal'];

    public function traerDeIngreso($id)
    {
        return $this->db->table("detingpro d")
                ->where("estadodetingpro", 1)
                ->where("idingreso", $id)
                ->join("producto p", "d.idproducto = p.idproducto")
                ->get()->getResultArray();
    }
}
