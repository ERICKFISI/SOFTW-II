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

}
