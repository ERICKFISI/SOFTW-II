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
//       echo "<pre>"; print_r($_SESSION);Exit;
        $datos = array();
        $tipoSalidaModel = new \App\Models\TipoSalidalModel();
        $datos['tiposalida'] = $tipoSalidaModel->where('estadotiposalida', 1)->findAll();
        $productoModel = new \App\Models\ProductoModel();
        $datos['producto'] = $productoModel->where('estadoproducto', 1)->findAll();
        echo $this->use_layout('salida/new', $datos);
    }

    function getPrecioThisProducto() {
        $idProducto = new \App\Models\ProductoModel();
        $dtProducto = $idProducto->find($_REQUEST['idproducto']);
        echo json_encode(array('resp' => 1, 'msg' => $dtProducto));
    }

    public function setProductoAlCarrito() {
//        print_r($_SESSION['add_carro']);Exit;
        $idproducto = $_REQUEST['idproducto'];
        $cantidad = $_REQUEST['cantidad'];
        $preciounidad = $_REQUEST['preciounidad'];
        $subtotal = $_REQUEST['subtotal'];
        $descripcion_producto = $_REQUEST['descripcion_producto'];

        if (isset($_SESSION['add_carro'][$idproducto])) {

            $_SESSION['add_carro'][$idproducto]['cantidad'] = $_SESSION['add_carro'][$idproducto]['cantidad'] + $cantidad;
            $_SESSION['add_carro'][$idproducto]['preciounidad'] = $preciounidad;
            $_SESSION['add_carro'][$idproducto]['subtotal'] = $_SESSION['add_carro'][$idproducto]['subtotal'] + $subtotal;
            $_SESSION['add_carro'][$idproducto]['descripcion_producto'] = $descripcion_producto;
        } else {

            $_SESSION['add_carro'][$idproducto] = $_REQUEST;
        }
        echo json_encode(array('resp' => 1, 'msg' => $_SESSION['add_carro'], 'total' => $this->getTotal()));
    }

    public function getTotal() {
        $total = 0;
        foreach ($_SESSION['add_carro'] as $key => $value) {
            $total += $value['subtotal'];
        }
        return $total;
    }

    public function eliminarProductoAlCarrito() {
        unset($_SESSION['add_carro'][$_REQUEST['idproducto']]);
        echo json_encode(array('resp' => 1, 'msg' => $_SESSION['add_carro'], 'total' => $this->getTotal(),'total'=>$this->getTotal()));
    }

    public function verificarProductoEnCarrito() {
        if (isset($_SESSION['add_carro'][$_REQUEST['idproducto']])) {
            echo json_encode(array("resp" => 1, 'msg' => 'ya existe El Producto en el carrito, desea Añadir a la cantidad del Producto?'));
        } else {
            echo json_encode(array("resp" => 0, 'msg' => 'no existe El Producto en el carrito'));
        }
    }

}
