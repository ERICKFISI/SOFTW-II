<?php

namespace App\Models;

use CodeIgniter\Model;

class DetalleSalidaProductoModel extends Model {

    protected $table = 'detsalpro';
    protected $primaryKey = 'iddetsalpro';
    protected $returnType = 'array';
    protected $allowedFields = ['idsalida', 'idproducto','cantidadsalida','preciounidad','estadodetsalpro','subtotal'];

    public function traerDeSalida($id)
    {
        return $this->db->table("detsalpro d")
                ->where("estadodetsalpro", 1)
                ->where("idsalida", $id)
                ->join("producto p", "d.idproducto = p.idproducto")
                ->get()->getResultArray();
    }
}
