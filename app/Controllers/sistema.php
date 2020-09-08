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

    public function Menu() {
        $data_menu = $this->data_menus($_SESSION['idperfil']);
//       echo "<pre>"; print_r($data_menu);exit;
        $menu_start = $this->menu_start($data_menu);
        return $menu_start;
    }

    function data_menus() {

        $bd = \Config\Database::connect();
        $sql = "SELECT * FROM view_menupadres where idperfil=" . $_SESSION['idperfil'];
        $consulta = $bd->query($sql);
        $items = $consulta->getResult();
//        $items = $ViewMenuPadres->where('idperfil', '=', $_SESSION['idperfil'])->findAll();

        $cont = 0;
        $cont2 = 0;
        foreach ($items as $valor) {
            $sql = "SELECT * FROM view_menuhijos where idmodulopadre=". $valor->idmodulo." and view_menuhijos.perfil = ".$_SESSION['idperfil'];
            $consulta = $bd->query($sql);
            $hijos = $consulta->getResult();
//            $hijos = DB::table('view_menuhijos')->where('idpadre', '=', $valor['idmodulo'])->where('idperfil', '=', $_SESSION['idperfil'])->get();
            if ($valor->url == "") {
                $url = "#";
            } else {
                $url = $valor->url;
            }
            $menu[$cont] = array(
                'texto' => $valor->modulo,
                'url' => $url,
                'enlaces' => array()
            );
            $cont2 = 0;
            foreach ($hijos as $h) {
                $menu[$cont]['enlaces'][$cont2] = array('idmodulo' => $h->idmodulo, 'texto' => $h->nombre,  'url' => $h->url);
                $cont2 ++;
            }
            $cont ++;
        }
        return $menu;
    }

    function menu_start($menu) {
      ///menu php
        $m = '<ul class="nav side-menu">';
//    echo "<pre>";print_r($menu);exit;
        foreach ($menu as $key => $value) {
            $tam_submenus = count($value['enlaces']);
            if ($tam_submenus == 0) {
                //sin menu hijos
                $m = $m . '<li>';
                $m = $m . '<a>';
                $m = $m . '<i class="menu-icon ' . $value['icon'] . '"></i>';
                $m = $m . ' <span class="menu-text">' . $value['texto'] . '</span>';
                $m = $m . '</a>';
                $m = $m . '</li>';
            } else {
                $m = $m . '<li>';
                $m = $m . '<a><i class="fa fa-home"></i>' . $value['texto'] . '<span class="fa fa-chevron-down"></span></a>';
                $m = $m . ' <ul class="nav child_menu">';
                $sub = $value['enlaces'];
                foreach ($sub as $key => $value2) {
                    $m = $m . "<li><a onclick=javascript:cargar_page('" . $value2['url'] . "');   style='cursor:pointer;'>" . $value2['texto'] . "</a></li>";
                }
                $m = $m . '</ul>';
                $m = $m . '</li>';
            }
        }
        $m = $m . '</ul>';
        return $m;
        //fin menu php
    }

}
