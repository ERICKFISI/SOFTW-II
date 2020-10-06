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

    public function ver($id)
    {
        $m_salida = new \App\Models\SalidaModel();
        $m_detalle = new \App\Models\DetalleSalidaProductoModel();

        $salida = $m_salida->traerSalidaPorId($id);
        $detalle = $m_detalle->traerDeSalida($id);

        $datos = ["salida" => $salida[0], "detalles" => $detalle];
        echo $this->use_layout('salida/ver', $datos);
    }

    public function delete($id)
    {
        $m_salida = new \App\Models\SalidaModel();
        $m_detalle = new \App\Models\DetalleSalidaProductoModel();

        $detalles = $m_detalle->traerDeSalida($id);
        $data = ["estadodetsalpro" => 0];
        foreach ($detalles as $detalle)
        {
            $m_detalle->update($detalle["iddetsalpro"], $data);
        }

        $data = ["estadosalida" => 0];
        $m_salida->update($id, $data);
        echo "<script>alert('Se elimin� correctamente la salida');window.location.href = '".base_url()."/salida';</script>";
    }

    public function edit($id)
    {
        $m_salida = new \App\Models\SalidaModel();
        $m_detalle = new \App\Models\DetalleSalidaProductoModel();

        $salida = $m_salida->traerSalidaPorId($id);
        $detalle = $m_detalle->traerDeSalida($id);

        $datos = ["salida" => $salida[0], "detalles" => $detalle];
        $tipoSalidaModel = new \App\Models\TipoSalidalModel();
        $datos['tiposalida'] = $tipoSalidaModel->where('estadotiposalida', 1)->findAll();
        $productoModel = new \App\Models\ProductoModel();
        $datos['producto'] = $productoModel->where('estadoproducto', 1)->findAll();
        echo $this->use_layout('salida/edit', $datos);
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
        echo json_encode(array('resp' => 1, 'msg' => $_SESSION['add_carro'], 'total' => $this->getTotal(), 'total' => $this->getTotal()));
    }

    public function verificarProductoEnCarrito() {
        if (isset($_SESSION['add_carro'][$_REQUEST['idproducto']])) {
            echo json_encode(array("resp" => 1, 'msg' => 'ya existe El Producto en el carrito, desea Añadir a la cantidad del Producto?'));
        } else {
            echo json_encode(array("resp" => 0, 'msg' => 'no existe El Producto en el carrito'));
        }
    }

    public function create() {
        $salidaModel = new \App\Models\SalidaModel();
        $DetalleSalidaProductoModel = new \App\Models\DetalleSalidaProductoModel();
        $data = [
            'idtiposalida' => $_REQUEST['idtiposalida'],
            'fechasalida' => $_REQUEST['fechasalida'],
            'descripcionsalida' => $_REQUEST['descripcionsalida'],
            'totalsalida' => $this->getTotal(),
            'estadosalida' => 1
        ];
        $idSalida = $salidaModel->insert($data);
//       echo "<pre>"; print_r($salida);Exit;
        foreach ($_SESSION['add_carro'] as $idproducto => $value) {
            $data = [
                'idsalida' => $idSalida,
                'idproducto' => $idproducto,
                'cantidadsalida' => $value['cantidad'],
                'preciounidad' => $value['preciounidad'],
                'subtotal' => $value['subtotal'],
                'estadodetsalpro' => 1
            ];
            $DetalleSalidaProductoModel->insert($data);
        }
        echo "<script>alert('Se guardó correctamente la información');window.location.href = '".base_url()."/salida';</script>";
    }

}
