<?php

namespace App\Controllers;

use CodeIgniter\Controller;

//use App\Models\ModeloUsuarios;

class Login extends BaseController {

    public function index() {
        echo view("header");
        echo view("login");
    }

    public function validar() {
        $bd = \Config\Database::connect();
        $texto_sql = "SELECT * FROM usuario WHERE nombreusuario = ? and contrasena = ? and estado = 1";
        $consulta = $bd->query($texto_sql, [$_POST["usuario"], $_POST["contra"]]);
        $registro = $consulta->getRow();
//        print_r($registro);exit;
        if (!empty($registro)) {
            // Aun no se como manejar este error, es decir, si el usuario no existe
            // Deberiamos mostrar de nuevo la pagina de "login" (al menos que sea otra pagina)
            // el problema es que no se como llamar, desde aqui desde esta funcion, a la misma pagina
            // de login
            $_SESSION['nombreusuario'] = $registro->nombreusuario;
            $_SESSION['nombre'] = $registro->nombre;
            $_SESSION['dni'] = $registro->dni;
            $_SESSION['telefono'] = $registro->telefono;
            $_SESSION['idperfil'] = $registro->idperfil;
            $_SESSION['idusuario'] = $registro->idusuario;            
            $perfilModel = new \App\Models\PerfilModel();
            $perfil = $perfilModel->find($registro->idperfil);
            $_SESSION['perfil'] = $perfil['nombre'];
            $_SESSION['perfil'] = die("<script>window.location='" . base_url() . "/sistema';</script>");
        } else {
            die("<script>window.location='" . base_url() . "';</script>");
        }
        // Si inicia sesion ¿a donde se le redigira y como?
        return redirect()->to( base_url().'/index.php/VisualizarUsuario');
        // Si inicia sesion ï¿½a donde se le redigira y como?
    }

    public function cerrar_session() {
        session_destroy();
        die("<script>window.location='" . base_url() . "';</script>");
    }

}
