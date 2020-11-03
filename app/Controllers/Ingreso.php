<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ModeloPermiso;

class Ingreso extends BaseController {

    public function index() {
        try
        {
            if( empty( $_SESSION[ 'nombre' ] ) )
            {
                return redirect()->to( base_url() . '/Login' );
            }
            else
            {
                $model = new ModeloPermiso();
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 12 );
                if( !empty( $perfil ) )
                {
                    $db = \Config\Database::connect();
                    $model = $db->query('SELECT ingreso.idingreso,ingreso.idtipoingreso,ingreso.idcomprobanteingreso,ingreso.fechaingreso, 
                ingreso.totalingreso,tipoingreso.tipoingreso, ingreso.descripcioningreso FROM ingreso
                INNER JOIN tipoingreso ON ingreso.idtipoingreso = tipoingreso.idtipoingreso 
                    WHERE ingreso.estadoingreso = 1');
                    $datos['ingreso'] = $model->getResultArray();
                    echo $this->use_layout('ingreso/visualizar_ingreso', $datos);
                }
                else
                {
                    return redirect()->to( base_url() . '/Sistema' );
                }
            }
        }
        catch( exception $e )
        {
            echo $e -> getMessage();
        }
    }

    public function new_() {
//       echo "<pre>"; print_r($_SESSION);Exit;
        try
        {
            if( empty( $_SESSION[ 'nombre' ] ) )
            {
                return redirect()->to( base_url() . '/Login' );
            }
            else
            {
                $model = new ModeloPermiso();
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 12 );
                if( !empty( $perfil ) )
                {
                    $datos = array();
                    $tipoIngresoModel = new \App\Models\TipoIngresoModel();
                    $datos['tipoingreso'] = $tipoIngresoModel->where('estadotipoingreso', 1)->findAll();
                    $productoModel = new \App\Models\ProductoModel();
                    $datos['producto'] = $productoModel->where('estadoproducto', 1)->findAll();
                    unset($_SESSION['add_carro2']);
                    echo $this->use_layout('ingreso/new', $datos);
                }
                else
                {
                    return redirect()->to( base_url() . '/Sistema' );
                }
            }
        }
        catch( exception $e )
        {
            echo $e -> getMessage();
        }
    }

    public function ver($id)
    {
        try
        {
            if( empty( $_SESSION[ 'nombre' ] ) )
            {
                return redirect()->to( base_url() . '/Login' );
            }
            else
            {
                $model = new ModeloPermiso();
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 12 );
                if( !empty( $perfil ) )
                {
                    $m_ingreso = new \App\Models\IngresoModel();
                    $m_detalle = new \App\Models\DetalleIngresoProductoModel();

                    $ingreso = $m_ingreso->traerIngresoPorId($id);
                    $detalle = $m_detalle->traerDeIngreso($id);

                    $datos = ["ingreso" => $ingreso[0], "detalles" => $detalle];
                    echo $this->use_layout('ingreso/ver', $datos);
                }
                else
                {
                    return redirect()->to( base_url() . '/Sistema' );
                }
            }
        }
        catch( exception $e )
        {
            echo $e -> getMessage();
        }
    }

    public function delete($id)
    {
        try
        {
            if( empty( $_SESSION[ 'nombre' ] ) )
            {
                return redirect()->to( base_url() . '/Login' );
            }
            else
            {
                $model = new ModeloPermiso();
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 12 );
                if( !empty( $perfil ) )
                {
                    $m_ingreso = new \App\Models\IngresoModel();
                    $m_detalle = new \App\Models\DetalleIngresoProductoModel();

                    $detalles = $m_detalle->traerDeIngreso($id);
                    $data = ["estadodetingpro" => 0];
                    foreach ($detalles as $detalle)
                    {
                        $m_detalle->update($detalle["iddetingpro"], $data);
                    }

                    $data = ["estadoingreso" => 0];
                    $m_ingreso->update($id, $data);
                    echo "<script>window.location.href = '".base_url()."/ingreso';</script>";
                }
                else
                {
                    return redirect()->to( base_url() . '/Sistema' );
                }
            }
        }
        catch( exception $e )
        {
            echo $e -> getMessage();
        }
    }
    public function edit($id) {
        try {
            if (empty($_SESSION['nombre'])) {
                return redirect()->to(base_url() . '/Login');
            } else {
                $model = new ModeloPermiso();
                $perfil = $model->ComprobarPermisos($_SESSION['idperfil'], 12);
                if (!empty($perfil)) {
                    $datos = array();
                    $tipoIngresoModel = new \App\Models\TipoIngresoModel();
                    $datos['tipoingreso'] = $tipoIngresoModel->where('estadotipoingreso', 1)->findAll();
                    $productoModel = new \App\Models\ProductoModel();
                    $datos['producto'] = $productoModel->where('estadoproducto', 1)->findAll();


                    $ingresoModel = new \App\Models\IngresoModel();
                    $DetalleIngresoProductoModel = new \App\Models\DetalleIngresoProductoModel();

                    $datos['ingreso'] = $ingresoModel->find($id);
                    $detalle_ingreso = $DetalleIngresoProductoModel->where('idingreso', $id)->findAll();
                    unset($_SESSION['add_carro2']);
                    foreach ($detalle_ingreso as $key => $value) {
                        $_SESSION['add_carro2'][$value['idproducto']]['cantidad'] = $value['cantidadingreso'];
                        $_SESSION['add_carro2'][$value['idproducto']]['preciounidad'] = $value['preciounidad'];
                        $_SESSION['add_carro2'][$value['idproducto']]['subtotal'] = $value['subtotal'];
                        $_SESSION['add_carro2'][$value['idproducto']]['descripcion_producto'] = $productoModel->find($value['idproducto'])['producto'];
                    }
                    echo $this->use_layout('ingreso/edit', $datos);
                } else {
                    return redirect()->to(base_url() . '/Sistema');
                }
            }
        } catch (exception $e) {
            echo $e->getMessage();
        }
    }

    function getPrecioThisProducto() {
        $idProducto = new \App\Models\ProductoModel();
        $dtProducto = $idProducto->find($_REQUEST['idproducto']);
        echo json_encode(array('resp' => 1, 'msg' => $dtProducto));
    }

    public function setProductoAlCarrito() {
//        print_r($_SESSION['add_carro2']);Exit;
        try
        {
            if( empty( $_SESSION[ 'nombre' ] ) )
            {
                return redirect()->to( base_url() . '/Login' );
            }
            else
            {
                $model = new ModeloPermiso();
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 12 );
                if( !empty( $perfil ) )
                {
                    $idproducto = $_REQUEST['idproducto'];
                    $cantidad = $_REQUEST['cantidad'];
                    $preciounidad = $_REQUEST['preciounidad'];
                    $subtotal = $_REQUEST['subtotal'];
                    $descripcion_producto = $_REQUEST['descripcion_producto'];

                    if (isset($_SESSION['add_carro2'][$idproducto])) {

                        $_SESSION['add_carro2'][$idproducto]['cantidad'] = $_SESSION['add_carro2'][$idproducto]['cantidad'] + $cantidad;
                        $_SESSION['add_carro2'][$idproducto]['preciounidad'] = $preciounidad;
                        $_SESSION['add_carro2'][$idproducto]['subtotal'] = $_SESSION['add_carro2'][$idproducto]['subtotal'] + $subtotal;
                        $_SESSION['add_carro2'][$idproducto]['descripcion_producto'] = $descripcion_producto;
                    } else {

                        $_SESSION['add_carro2'][$idproducto] = $_REQUEST;
                    }
                    echo json_encode(array('resp' => 1, 'msg' => $_SESSION['add_carro2'], 'total' => $this->getTotal()));
                }
                else
                {
                    return redirect()->to( base_url() . '/Sistema' );
                }
            }
        }
        catch( exception $e )
        {
            echo $e -> getMessage();
        }
    }

    public function getTotal() {
        $total = 0;
        foreach ($_SESSION['add_carro2'] as $key => $value) {
            $total += $value['subtotal'];
        }
        return $total;
    }

    public function eliminarProductoAlCarrito() {
        unset($_SESSION['add_carro2'][$_REQUEST['idproducto']]);
        echo json_encode(array('resp' => 1, 'msg' => $_SESSION['add_carro2'], 'total' => $this->getTotal(), 'total' => $this->getTotal()));
    }

    public function verificarProductoEnCarrito() {
        if (isset($_SESSION['add_carro2'][$_REQUEST['idproducto']])) {
            echo json_encode(array("resp" => 1, 'msg' => 'Ya existe el producto en el carrito, ¿Desea AÃ±adir a la cantidad del Producto?'));
        } else {
            echo json_encode(array("resp" => 0, 'msg' => 'No existe el producto en el carrito'));
        }
    }

    public function create() {
        try
        {
            if( empty( $_SESSION[ 'nombre' ] ) )
            {
                return redirect()->to( base_url() . '/Login' );
            }
            else
            {
                $model = new ModeloPermiso();
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 12 );
                if( !empty( $perfil ) )
                {
                    $ingresoModel = new \App\Models\IngresoModel();
                    $DetalleIngresoProductoModel = new \App\Models\DetalleIngresoProductoModel();
                    $data = [
                        'idtipoingreso' => $_REQUEST['idtipoingreso'],
                        'fechaingreso' => $_REQUEST['fechaingreso'],
                        'descripcioningreso' => $_REQUEST['descripcioningreso'],
                        'totalingreso' => $this->getTotal(),
                        'estadoingreso' => 1
                    ];
                    $idIngreso = $ingresoModel->insert($data);
            //       echo "<pre>"; print_r($ingreso);Exit;
                    foreach ($_SESSION['add_carro2'] as $idproducto => $value) {
                        $data = [
                            'idingreso' => $idIngreso,
                            'idproducto' => $idproducto,
                            'cantidadingreso' => $value['cantidad'],
                            'preciounidad' => $value['preciounidad'],
                            'subtotal' => $value['subtotal'],
                            'estadodetingpro' => 1
                        ];
                        $DetalleIngresoProductoModel->insert($data);
                        $productoModel = new \App\Models\ProductoModel();
                        $dtthisProducto = $productoModel->find($idproducto);
                        $productoModel->update($idproducto, array('stock' => ($dtthisProducto['stock'] + $value['cantidad'])));
                    }
                    unset($_SESSION['add_carro2']);
                    echo "<script>alert('Se guardó correctamente la información');window.location.href = '".base_url()."/ingreso';</script>";
                }
                else
                {
                    return redirect()->to( base_url() . '/Sistema' );
                }
            }
        }
        catch( exception $e )
        {
            echo $e -> getMessage();
        }
    }
    
    
        public function update($id) {
        try
        {
            if( empty( $_SESSION[ 'nombre' ] ) )
            {
                return redirect()->to( base_url() . '/Login' );
            }
            else
            {
                $model = new ModeloPermiso();
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 13 );
                if( !empty( $perfil ) )
                {
                    $ingresoModel = new \App\Models\IngresoModel();
                    $DetalleIngresoProductoModel = new \App\Models\DetalleIngresoProductoModel();
                    $data = [
                        'idtipoingreso' => $_REQUEST['idtipoingreso'],
                        'fechaingreso' => $_REQUEST['fechaingreso'],
                        'descripcioningreso' => $_REQUEST['descripcioningreso'],
                        'totalingreso' => $this->getTotal(),
                    ];
                    $ingresoModel->update($id, $data);
                    //Devolvemos Stock de Producto
                    $productoModel = new \App\Models\ProductoModel();
                    foreach ($DetalleIngresoProductoModel->where('idingreso', $id)->findAll() as $key => $value) {
                        $dtthisProducto = $productoModel->find($value['idproducto']);
                        $productoModel->update($value['idproducto'], array('stock' => ($dtthisProducto['stock'] - $value['cantidadingreso'])));
                    }

                    $DetalleIngresoProductoModel->where('idingreso', $id)->delete();
                    foreach ($_SESSION['add_carro2'] as $idproducto => $value) {
                        $data = [
                            'idingreso' => $id,
                            'idproducto' => $idproducto,
                            'cantidadingreso' => $value['cantidad'],
                            'preciounidad' => $value['preciounidad'],
                            'subtotal' => $value['subtotal'],
                            'estadodetsalpro' => 1
                        ];
                        $DetalleIngresoProductoModel->insert($data);
                        //actualizamos Stock de producto
                        $dtthisProducto = $productoModel->find($idproducto);
                        $productoModel->update($idproducto, array('stock' => ($dtthisProducto['stock'] + $value['cantidad'])));
                    }
                    unset($_SESSION['add_carro2']);
                    echo "<script>alert('Se Actualizó correctamente la información');window.location.href = '" . base_url() . "/ingreso';</script>";
                }
                else
                {
                    return redirect()->to( base_url() . '/Sistema' );
                }
            }
        }
        catch( exception $e )
        {
            echo $e -> getMessage();
        }
    }

}
