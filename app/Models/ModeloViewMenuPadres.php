<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeloViewMenuPadres extends Model
{
    protected $table = "view_menupadres";
        protected $returnType = "array";
            protected $primaryKey = "idmodulo";
    protected $allowedFields = [ "idmodulopadre", "modulo", "url",
                                "idperfil"];

}
