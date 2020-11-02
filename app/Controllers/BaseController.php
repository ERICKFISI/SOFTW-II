<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */
use CodeIgniter\Controller;

class BaseController extends Controller {

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Constructor.
     */
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger) {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        session_start();
        //--------------------------------------------------------------------
        // Preload any models, libraries, etc, here.
        //--------------------------------------------------------------------
        // E.g.:
        // $this->session = \Config\Services::session();
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
            $sql = "SELECT * FROM view_menuhijos where idmodulopadre=" . $valor->idmodulo . " and view_menuhijos.perfil = " . $_SESSION['idperfil'];
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
                $menu[$cont]['enlaces'][$cont2] = array('idmodulo' => $h->idmodulo, 'texto' => $h->nombre, 'url' => $h->url);
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
                $m = $m . '<a><i class="fa fa-home"></i>' . $value['texto'] . '<span class="fa fa-chevron-down"></span></a>';
                $m = $m . '</li>';
            } else {
                $m = $m . '<li>';
                $m = $m . '<a><i class="fa fa-home"></i>' . $value['texto'] . '<span class="fa fa-chevron-down"></span></a>';
                $m = $m . ' <ul class="nav child_menu">';
                $sub = $value['enlaces'];
                foreach ($sub as $key => $value2) {
                    $m = $m . "<li><a href= " . base_url() . "" . $value2['url'] . "   style='cursor:pointer;'>" . $value2['texto'] . "</a></li>";
                }
                $m = $m . '</ul>';
                $m = $m . '</li>';
            }
        }
        $m = $m . '</ul>';
        return $m;
        //fin menu php
    }

    public function use_layout($view, $data = [], $layout = "sistema") {
        $data['menu'] = $this->Menu();
        $data = array(
            'cont' => view($view, $data, ['saveData' => true])
        );
        return view('/layout/' . $layout, $data);
    }

}
