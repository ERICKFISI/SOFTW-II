<?php

namespace App\Controllers;

use App\Controllers\perfil;

class Home extends BaseController {

    public function index() {
        echo view('header');
        echo view('login');
    }

    public function registrarusuario() {

        $perfiles = new perfil();
        $perfiles = $perfiles->index();
        $data['perfiles'] = $perfiles;
        echo $this->use_layout('registrar_usuario', $data);
    }

    //--------------------------------------------------------------------
}
