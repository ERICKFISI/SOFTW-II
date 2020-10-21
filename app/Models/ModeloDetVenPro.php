<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeloDetVenPro extends Model
{
    protected $table = "detvenpro";
    protected $primaryKey = 'iddetvenpro';
    protected $returnType = 'array';
    protected $allowedFields = ['idventa', 'idproducto', 'cantidadventa', 'estadodetvenpro'];

    
}
