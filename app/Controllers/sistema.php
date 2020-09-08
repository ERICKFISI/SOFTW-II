<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Sistema extends BaseController {

    public function index() {
//       
        echo view('header');
        echo view('menu');
          echo view('sistema');
        echo view('footer');
    }

}
