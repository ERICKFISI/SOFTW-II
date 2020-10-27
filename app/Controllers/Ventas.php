<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ModeloVentas;
use App\Models\ModeloClientes;
use App\Models\UsuarioModel;
use App\Models\ProductoModel;
use App\Models\ComprobanteModel;
use App\Models\ModeloDetVenPro;

class Ventas extends BaseController
{
    public function index()
    {
        $modeloVentas = new ModeloVentas();

        $ventas = $modeloVentas->traerVentas();
        $data = ["ventas" => $ventas];

        echo $this->use_layout("ventas/visualizar_ventas", $data);
    }

    /* Vista de registrar una venta */
    public function registrar()
    {
        $mclientes = new ModeloClientes();
        $musuarios = new UsuarioModel();
        $mcomprobantes = new ComprobanteModel();
        $mproductos = new ProductoModel();

        $clientes = $mclientes->traerClientes();
        $usuarios = $musuarios->traerUsuarios();
        $comprobantes = $mcomprobantes->traerComprobantes();
        $productos = $mproductos->traerProductos();

        $data = ["clientes"     => $clientes,
                 "usuarios"     => $usuarios,
                 "comprobantes" => $comprobantes,
                 "productos"    => $productos];
        
        echo $this->use_layout("ventas/registrar", $data);
    }

    /* En realidad trae toda la informacion del producto :D */
    public function traerPrecioDeProducto()
    {
        $mproductos = new ProductoModel();

        $producto = $mproductos->traerProductoPorId($_POST["idproducto"]);
        return json_encode($producto[0], true);
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
            echo "<script>alert('Ingrese al menos un producto');window.location.href='".base_url()."/ventas/registrar';</script>";

        $dataVenta = ["idcliente"        => $_POST["idcliente"],
                      "direccioncliente" => $_POST["direccioncliente"],
                      "idusuario"        => $_POST["idusuario"],
                      "idcomprobante"    => $_POST["idcomprobante"],
                      "fechaventa"       => $_POST["fechaventa"],
                      "totalventa"       => $_POST["totalventa"]];
        $mventas = new ModeloVentas();
        //$idventa = $mventas->insert($dataVenta);
        
        $mcomprobantes = new ComprobanteModel();
        $com = $mcomprobantes->traerComprobantePorId($dataVenta["idcomprobante"]);
        $com = $com[0];
        
        /* Formamos el numero de serie de la venta */

        $contador = $com["contador"]; // El contador esta almacena en la tabla de comprobantes
        if ($contador >= 9999)
        {
            echo "<script>alert('No se puede registrar ventas, actualize el correlativo de su comprobante');window.location.href='".base_url()."/ventas';</script>";
        }
        $serie = $com["correlativo"]."-".$contador; // Se forma la seria
        $contador += 1;
        $mcomprobantes->update($dataVenta["idcomprobante"], ["contador" => $contador]);
        
        $dataVenta["serie"] = $serie;
        $idventa = $mventas->insert($dataVenta); // Se inserta la venta
        //$mventas->update($idventa, $data);

        $mdetalle = new ModeloDetVenPro();
        /* El detalle venta  */
        $indice = 0; // Para recorrer las cantidades
        foreach ($_POST["productos"] as $idproducto)
        {
            $dataDetVenta = ["idventa"       => $idventa,
                             "idproducto"    => $idproducto,
                             "cantidadventa" => $_POST["cantidades"][$indice++]];
            $mdetalle->insert($dataDetVenta);
        }
        echo "<script>alert('Venta guardada');window.location.href='".base_url()."/ventas';</script>";        
    }

    public function traerCliente()
    {
        $mclientes = new ModeloClientes();

        $cliente = $mclientes->traerClientePorId($_POST["idcliente"]);
        return json_encode($cliente[0], true);
    }

    public function ver($id)
    {
        $mventas = new ModeloVentas();
        //$mdetalle = new ModeloDetVenPro();

        $venta = $mventas->traerVentaPorId($id);
        $detalle = $mventas->traerDetDeVenta($id);

        $data = ["venta" => $venta[0], "detalles" => $detalle];

        echo $this->use_layout("ventas/ver", $data);        
    }

    public function eliminar($id)
    {
        $mventas = new ModeloVentas();

        $data = ["estadoventa" => 0];

        $mventas->update($id, $data);
        echo "<script>alert('Venta anulada');window.location.href='".base_url()."/ventas';</script>";
    }
}
