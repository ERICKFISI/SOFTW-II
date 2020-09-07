<?php

namespace App\Controllers;

use CodeIgniter\Controller;
//use App\Models\ModeloUsuarios;

class Login extends Controller
{
    public function index()
    {
        echo view("header");
		echo view("login");
    }

    public function validar()
    {
        $bd = \Config\Database::connect();
        $texto_sql = "SELECT * FROM usuario WHERE nombreusuario = ? and contrasena = ? and estado = 1";
        $consulta = $bd->query($texto_sql, [$_POST["usuario"], $_POST["contra"]]);
        $registro = $consulta->getRow();
        if (!isset($registro))
        {
            // Aun no se como manejar este error, es decir, si el usuario no existe
            // Deberiamos mostrar de nuevo la pagina de "login" (al menos que sea otra pagina)
            // el problema es que no se como llamar, desde aqui desde esta funcion, a la misma pagina
            // de login
            return;
        }
        // Si inicia sesion ¿a donde se le redigira y como?
    }
}
