<?php

namespace App\Models;

use CodeIgniter\Model;

class SalidaModel extends Model {

    protected $table = 'salida';
    protected $primaryKey = 'idsalida';
    protected $returnType = 'array';
    protected $allowedFields = ['idtiposalida', 'idcomprobantesalida', 'fechasalida', 'totalsalida', 'descripcionsalida', 'estadosalida'];

    public function traerSalidaPorId($id)
    {
        return $this->db->table("salida s")
                ->where("estadosalida", 1)
                ->where("idsalida", $id)
                ->join("tiposalida ts", "s.idtiposalida = ts.idtiposalida")
                ->get()->getResultArray();
    }
}
