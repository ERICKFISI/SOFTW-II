<?php

namespace App\Controllers;

use CodeIgniter\Controller;
//use App\Models\ModeloUsuarios;

class Registrarperfil extends BaseController
{
    public function index()
    {
        $bd = \Config\Database::connect();
        $sql = "SELECT * FROM modulo";
        $consulta = $bd->query($sql);
        $registros = $consulta->getResult();
        $data = ["registros" => $registros];
        echo $this->use_layout('registrar_perfil',$data);
    }

    public function crear()
    {
        $bd = \Config\Database::connect();
        $consulta = $bd->query("SELECT * FROM perfil WHERE nombre = ?", [$_POST["nombreperfil"], ]);
        $perfil = $consulta->getRow();
        if (isset($perfil))
        {
            return json_encode(["Estado" => 404, "Detalles" => "Este perfil ya existe"]);
        }
        $bd->query("INSERT INTO perfil (nombre) VALUES (?)", [$_POST["nombreperfil"], ]);
        if ($bd->affectedRows() != 1)
        {
            // Error al ingresar - hacia donde va a ir?
            return json_encode(["Estado" => 404, "Detalles" => "No se ingreso el dato"]);
        }
        // Obtenemos el idperfil recien creado
        $consulta = $bd->query("SELECT * FROM perfil WHERE nombre = ?", [$_POST["nombreperfil"], ]);
        $perfil = $consulta->getRow();

        foreach ($_POST["checks"] as $seleccion)
        {
            if (isset($seleccion) && !empty($seleccion))
            {
                $bd->query("INSERT INTO permiso (idmodulo, idperfil) VALUES (?, ".$perfil->idperfil.")", [$seleccion, ]);
            }
        }
        // Aqui hacia donde va a ir?
        return "Registro guardado";
    }
    
}
