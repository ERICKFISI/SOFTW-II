<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Salida extends BaseController {

    public function index() {
        $db = \Config\Database::connect();
        $model = $db->query('SELECT salida.idsalida,salida.idtiposalida,salida.idcomprobantesalida,salida.fechasalida, 
	salida.totalsalida,tiposalida.tiposalida, salida.descripcionsalida FROM salida
	INNER JOIN tiposalida ON salida.idtiposalida = tiposalida.idtiposalida 
        WHERE salida.estadosalida = 1');
        $datos['salida'] = $model->getResultArray();
        echo $this->use_layout('salida/visualizar_salida', $datos);
    }

    public function new_() {
        $datos = array();
        $tipoSalidaModel = new \App\Models\TipoSalidalModel();
        $datos['tiposalida'] = $tipoSalidaModel->where('estadotiposalida', 1)->findAll();
//       echo "<pre>"; print_r($datos['tiposalida']);exit;
        echo $this->use_layout('salida/new', $datos);
    }
    public function create() {
        
    }

}
