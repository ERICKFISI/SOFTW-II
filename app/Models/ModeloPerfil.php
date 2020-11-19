<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeloPerfil extends Model
{
    protected $table = "perfil";
    protected $primaryKey = "idperfil";
    protected $returnType = "array";
    protected $allowedFields = ["nombre", "estado"];

    // Validaciones y mensajes
    protected $validationRules = ["nombre" => "required|string|max_length[50]"];
    protected $validationMessages = ["nombre" => ["max_length" => "Se  ha sobrepasado el tamanio del texto"]];

    public function traerPerfiles()
    {
        return $this->db->table("perfil p")
                ->where("p.estado", 1)
                ->get()->getResultArray();
    }
}
