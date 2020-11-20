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
                                  "idseriecorrelativo"    => $_POST["idseriecorrelativo"],
                                  "serie"    => $_POST["serie"],
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
                    $model = new ModeloVentas();
                    $idventa = $model->insert( $dataVenta );
                    $mseriecorrelativo = new ModeloSerieComprobante();
                    $datos = $_POST[ "serie" ];
                   $datos = $datos + 1;
                   $data = $mseriecorrelativo->find( $_POST[ 'idseriecorrelativo' ] );
                   switch( strlen($datos) )
                   {
                        case '1':
                            $datos = "000".$datos;
                            break;
                        case '2':
                            $datos = "00".$datos;
                            break;
                        case '3':
                            $datos = "0".$datos;
                            break;
                        default;
                   }
                   $correlativo = array(
                    'correlativosc' => $datos
                   );
                  $updatecorrelativo = $mseriecorrelativo->update( $data[ 'idseriecorrelativo' ], $correlativo  );


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
                    //echo "<script>alert('Venta guardada');</script>";
                    //echo "<script>alert('Venta guardada');window.location.href='".base_url()."/ventas';</script>";
                    $this->hacerPdf($_POST);
                    

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

    /******************************************************************************************
    *
    * FUNCIONES PARA REALIZAR EL PDF
    *
    *******************************************************************************************/

    public function hacerPdf($data)
    {
        // Primero obtenemos todos los datos en texto, para al final solo insertar en el pdf
        $mclientes = new ModeloClientes();
        $mserie = new ModeloSerieComprobante();
        $mproductos = new ProductoModel();
        $mcomprobantes = new ComprobanteModel();

        $cliente = $mclientes->traerClientePorId($data["idcliente"]);
        $documento = $cliente[0]["documento"];       // Documento (RUC o DNI)
        $cliente = $cliente[0]["razonsocial"];       // Cliente
        $direccion = $data["direccioncliente"];      // Direccion

        $serie = $mserie->traerSerieComprobantePorId($data["idseriecorrelativo"]);
        $idcomprobante = $serie[0]["idcomprobante"];
        $serie = $serie[0]["seriesc"];               // Serie
        $comprobante = $mcomprobantes->traerComprobantePorId($idcomprobante);
        $comprobante = strtoupper($comprobante[0]["comprobante"]); // Tipo de Comprobante

        $pdf = new \FPDF();
        $pdf->SetFont("Arial", "", 12);
        $pdf->AddPage();
        $numeracion = [$data["serie"], $serie];

        $this->cabecera($pdf, $numeracion, $comprobante." DE VENTA");
        $this->info_venta($pdf, $cliente, $direccion, $documento, $data["fechaventa"]);

        /* Formamos la tabla del detalle venta */
        $cabecera = ["CANT.", "DESCRIPCION", "P. UNIT.", "IMPORTE"]; // Titulos de la tabla
        $tams = [20, 80, 30, 50]; // Tamanio de las columnas (Ancho)
        // Configaramos la colores para la cabecera de la tabla
        $pdf->SetFillColor(255,0,0);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(128,0,0);
        $pdf->SetLineWidth(.3);
        // Cabecera de la tabla
        $c = 0;
        foreach($cabecera as $col)
            $pdf->Cell($tams[$c++], 7, $col, 1, 0, "C", true);
        $pdf->Ln();
        // Volvemos a los colores normales
        $pdf->SetFillColor(224,235,255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $lleno = false;

        // Productos - el cuerpo de la tabla
        $indice = 0; // Para recorrer las cantidades
        foreach ($data["productos"] as $idproducto)
        {
            $productoActual = $mproductos->traerProductoPorId($idproducto); // Se trae el producto
            $productoActual = $productoActual[0];

            $sub = $data["cantidades"][$indice] * $productoActual["preciounidad"];

            $pdf->Cell($tams[0], 6, $data["cantidades"][$indice],'LR',0,'L',$lleno);
            $pdf->Cell($tams[1], 6, $productoActual["producto"], 'LR', 0, 'L',$lleno);
            $pdf->Cell($tams[2], 6, number_format($productoActual["preciounidad"]),'LR',0,'R',$lleno);
            $pdf->Cell($tams[3], 6, number_format($sub),'LR',0,'R',$lleno);
            $pdf->Ln();
            $lleno = !$lleno;
            $indice++;
        }
        $pdf->Cell(array_sum($tams), 0, "", "T"); // Linea de cierre de la tabla
        $pdf->Ln();
        $pdf->Cell($tams[0] + $tams[1]); // Movernos y posicionarnos el la columa de P. UNIT
        $pdf->Cell($tams[2], 6, "TOTAL", 1);
        $pdf->Cell($tams[3], 6, number_format($data["totalventa"]), 1, 0, "R");
                          

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output();

    }

    // Colocar la cabecera de la boleta, en $data tiene que ir el numero de serie y el correlativo
    // $tipo -> Tipo de comprobante ("BOLETA DE VENTA" | "FACTURA")
    public function cabecera(&$pdf, $data, $tipo)
    {
        // La cabecera se divide en dos lados - derecha e izquierda
        // Izquierda
        $pdf->Ln();
        $pdf->Cell(60, 10, "Motorepuestos J&C", "B");
        // Derecha
        $pdf->Cell(70); // Nos movemos a la derecha
        $pdf->MultiCell(60, 10, "RUC: 20344523451\n".$tipo."\n".$data[1]." - ".$data[0], 1, "C");
        $pdf->Ln();
    }

    // Colocar la informacion de la venta
    public function info_venta(&$pdf, $cliente, $direccion, $doc, $fecha)
    {
        $pdf->Ln();
        $pdf->Cell(100, 10, "Señor (es): ".$cliente, 0);
        $pdf->Ln();
        $pdf->Cell(100, 10, "Dirección: ".$direccion, 0);
        $pdf->Ln();
        $pdf->Cell(50, 10, "Documento: ".$doc, 0);
        $pdf->Cell(60);
        $pdf->Cell(50, 10, "Fecha: ".$fecha, 0);
        $pdf->Ln();
    }

    /******************************************************************************************
    *
    * FIN DE LAS FUNCIONES PARA REALIZAR EL PDF
    *
    *******************************************************************************************/


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
