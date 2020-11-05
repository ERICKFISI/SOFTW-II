<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ModeloCompras;
use App\Models\ProductoModel;
use App\Models\ComprobanteModel;
use App\Models\ModeloDetCompro;
use App\Models\ModeloProveedor;
use App\Models\ModeloPermiso;

class Compras extends BaseController
{
    public function index()
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
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 9 );
                if( !empty( $perfil ) )
                {
                    $modeloCompras = new ModeloCompras();
                    $compras = $modeloCompras->traerCompras();
                    $data = ["compras" => $compras];

                    echo $this->use_layout("compras/visualizar_compras", $data);
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

    /* Vista de registrar una compra */
    public function registrar()
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
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 9 );
                if( !empty( $perfil ) )
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

    /* En realidad trae toda la informacion del producto :D */
    public function traerPrecioDeProducto()
    {
        try
        {
            if( empty( $_SESSION[ 'nombre' ] ) )
            {
                return redirect()->to( base_url() . '/Login' );
            }
            else
            {
                $mproductos = new ProductoModel();
                $producto = $mproductos->traerProductoPorId($_POST["idproducto"]);
                return json_encode($producto[0], true);
            }
        }
        catch( exception $e )
        {
            echo $e -> getMessage();
        }
    }

    public function traerProveedor()
    {
        $mproveedores = new ModeloProveedor();
        $proveedor = $mproveedores->traerProveedorPorId($_POST["idproveedor"]);
        return json_encode($proveedor[0]);
    }

    public function crear()
    {
        try
        {
            if( empty( $_SESSION[ 'nombre' ] ) )
            {
                return redirect()->to( base_url() . '/Login' );
            }
            else
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
                $idcompra = $mcompras->insert($dataCompra);

                // Realizamos el numero de serie
                $mcompro = new ComprobanteModel();
                $compro = $mcompro->traerComprobantePorId($_POST["idcomprobante"]);
                $correlativo = $compro[0]["correlativo"];
                $contador = $compro[0]["contador"];
                $serie = $correlativo."-".$contador;

                $mcompras->update($idcompra, ["serie" => $serie]); // Insertamos el numero de serie

                // Actualizamos el contador del numero de serie
                $contador += 1;
                $mcompro->update($_POST["idcomprobante"], ["contador" => $contador]);


                $mproductos = new ProductoModel();
                $mdetalle = new ModeloDetCompro();
                /* El detalle compra  */
                $indice = 0; // Para recorrer las cantidades
                foreach ($_POST["productos"] as $idproducto)
                {
                    $dataDetCompra = ["idcompra"      => $idcompra,
                                      "idproducto"     => $idproducto,
                                      "cantidadcompra" => $_POST["cantidades"][$indice],
                                      "preciocompraunidad" => $_POST["preciounidades"][$indice]];
                    $mdetalle->insert($dataDetCompra); // Se inserta el detalle de compra
                    $productoActual = $mproductos->traerProductoPorId($idproducto); // Se trae el producto
                    $productoActual = $productoActual[0];
                    $nuevoStock = $productoActual["stock"] + $_POST["cantidades"][$indice]; // Se calcula el nuevo stock
                    $mproductos->update($idproducto, ["stock" => $nuevoStock]); // Se actualiza el stock
                    $indice++;
                }
                echo "<script>alert('Compra guardada');window.location.href='".base_url()."/compras';</script>";
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
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 9 );
                if( !empty( $perfil ) )
                {
                    $mcompras = new ModeloCompras();
                    $compra = $mcompras->traerCompraPorId($id);
                    $detalle = $mcompras->traerDetDeCompra($id);

                    $data = ["compra" => $compra[0], "detalles" => $detalle];

                    echo $this->use_layout("compras/ver", $data);
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

    public function eliminar($id)
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
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 9 );
                if( !empty( $perfil ) )
                {
                    $mcompras = new ModeloCompras();
                    $data = ["estadocompra" => 0];
                    $mcompras->update($id, $data);
                    echo "<script>alert('Compra anulada');window.location.href='".base_url()."/compras';</script>";
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
