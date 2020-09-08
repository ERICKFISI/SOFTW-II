<?php

namespace App\Controllers;

use CodeIgniter\Controller;
//use App\Models\ModeloUsuarios;

class Registrarperfil extends Controller
{
    public function index()
    {
        echo view("header");
        echo view("menu");
		echo view("registrar_perfil");
        echo view("footer");
    }

    public function crear()
    {
        $bd = \Config\Database::connect();
        $bd->query("INSERT INTO perfil (nombre) VALUES (?)", [$_POST["nombreperfil"], ]);
        if ($bd->affectedRows() != 1)
        {
            // Error al ingresar - hacia donde va a ir?
            return json_encode(["Estado" => 404, "Detalles" => "No se ingreso el dato"]);
        }
        // Aqui hacia donde va a ir?
        return "Registro guardado";
    }
    
}
