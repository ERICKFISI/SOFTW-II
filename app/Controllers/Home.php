<?php

namespace App\Controllers;

use App\Controllers\perfil;
use App\Controllers\Categoriaproducto;
use App\Controllers\Marcaproducto;

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

    public function registrarproducto() {

        $categorias = new Categoriaproducto();
        $categorias = $categorias->index();
        $data['categorias'] = $categorias;
        $marcas = new Marcaproducto();
        $marcas = $marcas->index();
        $lineas = new Lineaproducto();
        $lineas = $lineas->index();

        $data['marcas'] = $marcas;
        $data['lineas'] = $lineas;
        echo $this->use_layout('registrar_producto', $data);
    }

    public function registrarmarca()
    {
        echo $this->use_layout('registrar_marca');
    }
    //--------------------------------------------------------------------
}
