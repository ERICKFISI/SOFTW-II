<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeloModulo extends Model
{
    protected $table = "modulo";
    protected $primaryKey = "idmodulo";
    protected $returnType = "array";
    protected $allowedFields = ["nombre", "url", "idmodulopadre", "estado"];

    protected $validationRules = ["nombre"        => "required|string|max_length[50]",
                                  "url"           => "required|string|max_length[75]",
                                  "idmodulopadre" => "required"];
    protected $validationMessages = ["nombre" => ["max_length" => "Se  ha sobrepasado el tamanio del texto"],
                                     "url"    => ["max_length" => "Se  ha sobrepasado el tamanio del texto"]
                                    ];
    
    
}
