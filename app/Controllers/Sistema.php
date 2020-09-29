<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Sistema extends BaseController {

    public function index() {
        echo $this->use_layout('bienvenida', array("nombre_systema" => "Motorepuestos JC"));//parametros view,data,layout_ruta
    }

}
