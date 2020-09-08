<?php

namespace App\Controllers;

use App\Controllers\perfil;

class Home extends BaseController {

    public function index() {
        echo view('header');
        echo view('login');
    }

    public function registrarusuario() {
        $data = array(
            'menu' => $this->Menu()
        );
        echo view('header');
        echo view('menu',$data);

        $perfiles = new perfil();
        $perfiles = $perfiles->index();
        $data['perfiles'] = $perfiles;
        echo view('registrar_usuario', $data);

        echo view('footer');
    }

    //--------------------------------------------------------------------
}
