<?php

namespace App\Models;

use CodeIgniter\Model;

class IngresoModel extends Model {

    protected $table = 'ingreso';
    protected $primaryKey = 'idingreso';
    protected $returnType = 'array';
    protected $allowedFields = ['idtipoingreso', 'idcomprobanteingreso', 'fechaingreso', 'totalingreso', 'descripcioningreso', 'estadoingreso'];

    public function traerIngresoPorId($id)
    {
        return $this->db->table("ingreso i")
                ->where("estadoingreso", 1)
                ->where("idingreso", $id)
                ->join("tipoingreso ti", "i.idtipoingreso = ti.idtipoingreso")
                ->get()->getResultArray();
    }
}
