<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeloUsuario extends Model
{
    protected $table = "usuario";
    protected $primaryKey = "idusuario";
    protected $returnType = "array";
    protected $allowedFields = ["nombreusuario", "nombre", "contrasena", "dni",
                                "telefono", "idperfil", "estado"];

    // Validaciones y mensajes
    protected $validationRules = ["nombreusuario" => "required|string|max_length[25]",
                                  "nombre"        => "required|string|max_length[40]",
                                  "contrasena"    => "required|string|max_length[8]",
                                  "dni"           => "required|string|max_length[8]",
                                  "telefono"      => "required|string|max_length[9]",
                                  "idperfil"      => "required"
                                  ];
    protected $validationMessages = ["nombreusuario" => ["max_length" => "Se  ha sobrepasado el tamanio del texto"],
                                     "nombre"        => ["max_length" => "Se  ha sobrepasado el tamanio del texto"],
                                     "contrasena"    => ["max_length" => "Se  ha sobrepasado el tamanio del texto"],
                                     "dni"           => ["max_length" => "Se  ha sobrepasado el tamanio del texto"],
                                     "nombre"        => ["max_length" => "Se  ha sobrepasado el tamanio del texto"],
                                     "nombre"        => ["max_length" => "Se  ha sobrepasado el tamanio del texto"]
                                     ];
}
