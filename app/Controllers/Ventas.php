<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ModeloVentas;
use App\Models\ModeloClientes;
use App\Models\UsuarioModel;
use App\Models\ProductoModel;
use App\Models\ComprobanteModel;
use App\Models\ModeloDetVenPro;
use App\Models\ModeloPermiso;
use App\Models\ModeloSerieComprobante;

class Ventas extends BaseController
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
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 6 );
                if( !empty( $perfil ) )
                {
                    $modeloVentas = new ModeloVentas();
                    $ventas = $modeloVentas->traerVentas();
                    $data = ["ventas" => $ventas];

                    echo $this->use_layout("ventas/visualizar_ventas", $data);
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

    /* Vista de registrar una venta */
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
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 6 );
                if( !empty( $perfil ) )
                {
                    $mclientes = new ModeloClientes();
                    $musuarios = new UsuarioModel();
                    $mcomprobantes = new ComprobanteModel();
                    $mproductos = new ProductoModel();
                    $mseriecomprobantes = new ModeloSerieComprobante();

                    $clientes = $mclientes->traerClientes();
                    $usuarios = $musuarios->traerUsuarios();
                    $comprobantes = $mcomprobantes->traerComprobantes();
                    $seriecomprobantes = $mseriecomprobantes->traerSerieComprobante();
                    $productos = $mproductos->traerProductos();

                    $data = ["clientes"     => $clientes,
                             "usuarios"     => $usuarios,
                             "comprobantes" => $comprobantes,
                             "seriecomprobantes"=> $seriecomprobantes,
                             "productos"    => $productos];
                    
                    echo $this->use_layout("ventas/registrar", $data);
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
                $model = new ModeloPermiso();
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 6 );
                if( !empty( $perfil ) )
                {
                    $mproductos = new ProductoModel();
                    $producto = $mproductos->traerProductoPorId($_POST["idproducto"]);
                    return json_encode($producto[0], true);
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

    public function traerCliente()
    {
        $mclientes = new ModeloClientes();
        $cliente = $mclientes->traerClientePorId($_POST["idcliente"]);
        return json_encode($cliente[0]);
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
                $model = new ModeloPermiso();
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 6 );
                if( !empty( $perfil ) )
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

                    // Antes que nada verifiquemos que tenemos la cantidad que se desea
                    $correcto = true;
                    
                    $mproductos = new ProductoModel();
                    /* El detalle venta  */
                    $indice = 0; // Para recorrer las cantidades
                    foreach ($_POST["productos"] as $idproducto)
                    {
                        $productoActual = $mproductos->traerProductoPorId($idproducto);
                        $productoActual = $productoActual[0];
                        if ($productoActual["stock"] < $_POST["cantidades"][$indice])
                        {
                            $correcto = false;
                            break;
                        }
                        $indice++;
                    }
                    if ($correcto == false)
                    {
                        echo "<script>alert('No hay esas cantidades para vender');window.location.href='".base_url()."/ventas/registrar';</script>";
                        return;
                    }
                    
                    $mventas = new ModeloVentas();
                    $idventa = $mventas->insert($dataVenta);

                    // Realizamos el numero de serie
                    $mcompro = new ComprobanteModel();
                    $compro = $mcompro->traerComprobantePorId($_POST["idcomprobante"]);
                    $correlativo = $compro[0]["correlativo"];
                    $contador = $compro[0]["contador"];
                    $serie = $correlativo."-".$contador;

                    $mventas->update($idventa, ["serie" => $serie]); // Insertamos el numero de serie

                    // Actualizamos el contador del numero de serie
                    $contador += 1;
                    $mcompro->update($_POST["idcomprobante"], ["contador" => $contador]);


                    $mdetalle = new ModeloDetVenPro();
                    /* El detalle venta  */
                    $indice = 0; // Para recorrer las cantidades
                    foreach ($_POST["productos"] as $idproducto)
                    {
                        $dataDetVenta = ["idventa"       => $idventa,
                                         "idproducto"    => $idproducto,
                                         "cantidadventa" => $_POST["cantidades"][$indice]];
                        $mdetalle->insert($dataDetVenta);
                        $productoActual = $mproductos->traerProductoPorId($idproducto); // Se trae el producto
                        $productoActual = $productoActual[0];
                        $nuevoStock = $productoActual["stock"] - $_POST["cantidades"][$indice]; // Se calcula el nuevo stock
                        $mproductos->update($idproducto, ["stock" => $nuevoStock]); // Se actualiza el stock
                        $indice++;
                    }
                    echo "<script>alert('Venta guardada');window.location.href='".base_url()."/ventas';</script>";
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
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 6 );
                if( !empty( $perfil ) )
                {
                    $mventas = new ModeloVentas();
                    //$mdetalle = new ModeloDetVenPro();

                    $venta = $mventas->traerVentaPorId($id);
                    $detalle = $mventas->traerDetDeVenta($id);

                    $data = ["venta" => $venta[0], "detalles" => $detalle];

                    echo $this->use_layout("ventas/ver", $data);
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
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 6 );
                if( !empty( $perfil ) )
                {
                    $mventas = new ModeloVentas();
                    $mproductos = new ProductoModel();
                    
                    // Traer el detalle de venta
                    $detVenta = $mventas->traerDetDeVenta($id);
                    foreach ($detVenta as $detalle)
                    {
                        $producto = $mproductos->traerProductoPorId($detalle["idproducto"]);
                        $stockActual = $producto[0]["stock"];
                        $stock = $stockActual + $detalle["cantidadventa"];
                        $mproductos->update($detalle["idproducto"], ["stock" => $stock]);
                    }

                    $data = ["estadoventa" => 0];
                    $mventas->update($id, $data);
                    echo "<script>alert('Venta anulada');window.location.href='".base_url()."/ventas';</script>";
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
