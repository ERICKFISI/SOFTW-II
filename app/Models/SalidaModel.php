<?php

namespace App\Models;

use CodeIgniter\Model;

class SalidaModel extends Model {

    protected $table = 'salida';
    protected $primaryKey = 'idsalida';
    protected $returnType = 'array';
    protected $allowedFields = ['idtiposalida', 'idcomprobantesalida', 'fechasalida', 'totalsalida', 'descripcionsalida', 'estadosalida'];

}
