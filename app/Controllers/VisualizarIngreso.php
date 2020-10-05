<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Controllers\ComprobanteModel;
use App\Controllers\DetIngProModel;
use App\Controllers\IngresoModel;
use App\Controllers\ProductoModel;
use App\Controllers\TipoIngresoModel;


class VisualizarIngreso extends BaseController
{
	public function index()
	{	
		$db = \Config\Database::connect();
        $model = $db->query('SELECT ingreso.idingreso,ingreso.idtipoingreso,ingreso.idcomprobanteingreso,ingreso.fechaingreso, 
	ingreso.totalingreso,tipoingreso.tipoingreso, ingreso.descripcioningreso FROM ingreso
	INNER JOIN tipoingreso ON ingreso.idtipoingreso = tipoingreso.idtipoingreso
        WHERE ingreso.estadoingreso = 1');
        $datos['ingreso'] = $model->getResultArray();
        echo $this->use_layout('visualizar_ingreso', $datos);
	}
	
	public function new_() {
//       echo "<pre>"; print_r($_SESSION);Exit;
        $datos = array();
        $tipoingreso = new TipoIngresoModel();
		$compprobante = new ComprobanteModel();
        $tipoIngresoModel = new TipoIngresoModel();
        $datos['tipoingreso'] = $tipoIngresoModel->where('estadotipoingreso', 1)->findAll();
        $productoModel = new ProductoModel();
        $datos['producto'] = $productoModel->where('estadoproducto', 1)->findAll();
        echo $this->use_layout('registrar_ingreso', $datos);
    }

    function getPrecioThisProducto() {
        $idProducto = new ProductoModel();
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

	public function create()
	{
		$ingresoModel = new IngresoModel();
        $DetalleIngresoProductoModel = new DetIngProModel();
        $data = [
            'idtipoingreso' => $_REQUEST['idtipoingreso'],
            'idcomprobanteingreso' => $_REQUEST['idcomprobanteingreso'],
            'fechaingreso' => $_REQUEST['fechaingreso'],
            'descripcioningreso' => $_REQUEST['descripcioningreso'],
            'totalingreso' => $this->getTotal(),
            'estadoingreso' => 1
        ];
        $idIngreso = $ingresoModel->insert($data);
//       echo "<pre>"; print_r($ingreso);Exit;
        foreach ($_SESSION['add_carro'] as $idproducto => $value) {
            $data = [
                'idingreso' => $idIngreso,
                'idproducto' => $idproducto,
                'cantidadingreso' => $value['cantidad'],
                'preciounidad' => $value['preciounidad'],
                'subtotal' => $value['subtotal'],
                'estadodetingpro' => 1
            ];
            $DetalleIngresoProductoModel->insert($data);
        }
        echo "<script>alert('Se guardó correctamente la información');window.location.href = '".base_url()."visualizar_ingreso';</script>";
	}

	public function getupdate( $id )
	{
		helper('form');
        $categorias = new Categoriaproducto();
        $categorias = $categorias->index();
        $marcas = new Marcaproducto();
        $marcas = $marcas->index();
        $productos = new ProductoModel();
        
        $data['producto'] = $productos->where('estadoingreso', 1)->find($id);
        $data['categorias'] = $categorias;
        $data['marcas'] = $marcas;
        echo $this->use_layout('modificar_ingreso', $data);
	}

	public function update( $id )
	{
		$request = \Config\Services::request();
        $model = new IngresoModel();
        $datos = [
            'idtipoingreso' => $request->getPost('idtipoingreso'),
            'idcomprobante' => $request->getPost('idcomprobante'),
            'fechaingreso' => $request->getPost('fechaingreso'),
            'totalingreso' => $request->getPost('totalingreso'),
            'descripcioningreso' => $request->getPost('descripcioningreso'),
        ];
        $model->update($id, $datos);
        return redirect()->to(base_url() . 'visualizar_ingreso');
	}

	public function delete( $id )
	{
		$db = \Config\Database::connect();
        $model2 = $db->query("UPDATE ingreso SET estadoingreso = 0 WHERE idingreso = $id AND estadoingreso = 1");
        return redirect()->to(base_url() . '/index.php/VisualizarIngreso');
	}
}