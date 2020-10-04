<?php

namespace App\Models;

use CodeIgniter\Model;

class DetalleSalidaProductoModel extends Model {

    protected $table = 'detsalpro';
    protected $primaryKey = 'iddetsalpro';
    protected $returnType = 'array';
    protected $allowedFields = ['idsalida', 'idproducto','cantidadsalida','preciounidad','estadodetsalpro','subtotal'];

}
