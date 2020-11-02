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
    public function ComprobarPermisos( $idperfil, $idmodulo )
    {
 		$db = \Config\Database::connect();
 		$texto_sql = "SELECT m.nombre FROM permiso AS p INNER JOIN perfil AS per ON p.idperfil = per.idperfil INNER JOIN modulo AS m ON m.idmodulo = p.idmodulo WHERE m.estado = 1 AND p.estado = 1 AND per.estado = 1 AND per.idperfil = ? AND p.idmodulo = ?";
 		$consulta = $db->query($texto_sql, [$idperfil, $idmodulo]);
 		return $consulta->getRow();	
    }
}
