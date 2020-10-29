<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ModeloCompras;
use App\Models\ProductoModel;
use App\Models\ComprobanteModel;
use App\Models\ModeloDetCompro;
use App\Models\ModeloProveedor;

class Compras extends BaseController
{
    public function index()
    {
        $modeloCompras = new ModeloCompras();

        $compras = $modeloCompras->traerCompras();
        $data = ["compras" => $compras];

        echo $this->use_layout("compras/visualizar_compras", $data);
    }

    /* Vista de registrar una compra */
    public function registrar()
    {
        $mcomprobantes = new ComprobanteModel();
        $mproductos = new ProductoModel();
        $mproveedores = new ModeloProveedor();

        $comprobantes = $mcomprobantes->traerComprobantes();
        $productos = $mproductos->traerProductos();
        $proveedores = $mproveedores->traerProveedores();

        $data = ["proveedores"  => $proveedores,
                 "comprobantes" => $comprobantes,
                 "productos"    => $productos];
        
        echo $this->use_layout("compras/registrar", $data);
    }

    /* En realidad trae toda la informacion del producto :D */
    public function traerPrecioDeProducto()
    {
        $mproductos = new ProductoModel();

        $producto = $mproductos->traerProductoPorId($_POST["idproducto"]);
        return json_encode($producto[0], true);
    }

    public function traerProveedor()
    {
        $mproveedores = new ModeloProveedor();

        $proveedor = $mproveedores->traerProveedorPorId($_POST["idproveedor"]);
        return json_encode($proveedor[0], true);
    }

    public function crear()
    {
        $existeProducto = false;

        /* Agrego algun producto?... Esto deberia validarse en la vista */
        foreach ($_POST as $clave => $valor)
        {
            if ($clave == "productos")
            {
                $existeProducto = true;
                break;
            }
        }
        if ($existeProducto == false)
            echo "<script>alert('Ingrese al menos un producto');window.location.href='".base_url()."/compras/registrar';</script>";

        $dataCompra = ["idproveedor"      => $_POST["idproveedor"],
                       "direccioncompra"  => $_POST["direccioncompra"],
                       "idcomprobante"    => $_POST["idcomprobante"],
                       "fechacompra"      => $_POST["fechacompra"],
                       "totalcompra"      => $_POST["totalcompra"]];
        $mcompras = new ModeloCompras();

        $mcomprobantes = new ComprobanteModel();
        $com = $mcomprobantes->traerComprobantePorId($dataCompra["idcomprobante"]);
        $com = $com[0];
        
        /* Formamos el numero de serie de la compra */

        $contador = $com["contador"]; // El contador esta almacena en la tabla de comprobantes
        if ($contador >= 9999)
        {
            echo "<script>alert('No se puede registrar compras, actualize el correlativo de su comprobante');window.location.href='".base_url()."/compras';</script>";
        }
        $serie = $com["correlativo"]."-".$contador; // Se forma la seria
        $contador += 1;
        $mcomprobantes->update($dataVenta["idcomprobante"], ["contador" => $contador]);
        
        $dataCompra["serie"] = $serie;

        $idcompra = $mcompras->insert($dataCompra);

        $mdetalle = new ModeloDetCompro();
        /* El detalle compra  */
        $indice = 0; // Para recorrer las cantidades
        foreach ($_POST["productos"] as $idproducto)
        {
            $dataDetCompra = ["idcompra"      => $idcompra,
                              "idproducto"     => $idproducto,
                              "cantidadcompra" => $_POST["cantidades"][$indice],
                              "preciocompraunidad" => $_POST["preciounidades"][$indice++]];
            $mdetalle->insert($dataDetCompra);
        }
        echo "<script>alert('Compra guardada');window.location.href='".base_url()."/compras';</script>";        
    }

    public function ver($id)
    {
        $mcompras = new ModeloCompras();

        $compra = $mcompras->traerCompraPorId($id);
        $detalle = $mcompras->traerDetDeCompra($id);

        $data = ["compra" => $compra[0], "detalles" => $detalle];

        echo $this->use_layout("compras/ver", $data);        
    }

    public function eliminar($id)
    {
        $mcompras = new ModeloCompras();

        $data = ["estadocompra" => 0];

        $mcompras->update($id, $data);
        echo "<script>alert('Compra anulada');window.location.href='".base_url()."/compras';</script>";
    }
}
