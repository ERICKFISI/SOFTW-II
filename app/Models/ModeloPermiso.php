<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeloPermiso extends Model
{
    protected $table = "permiso";
    protected $primaryKey = "idpermiso";
    protected $returnType = "array";
    protected $allowedFields = ["idmodulo", "idperfil", "estado"];

    protected $validationRules = ["idmodulo" => "required",
                                  "idperfil" => "required"];
}
