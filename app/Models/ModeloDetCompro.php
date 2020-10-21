<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeloDetCompro extends Model
{
    protected $table = "detcompro";
    protected $primaryKey = 'iddetcompro';
    protected $returnType = 'array';
    protected $allowedFields = ['idcompra', 'idproducto', 'preciocompraunidad',
                                'cantidadcompra', 'estadodetcompro'];
}
