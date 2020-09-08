<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Sistema extends BaseController {

    public function index() {
//       
        $data = array(
            'menu' => $this->Menu()
        );
        echo view('header');
        echo view('menu', $data);
        echo view('sistema');
        echo view('footer');
    }

  

}
