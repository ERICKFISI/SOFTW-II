<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProductoModel;
use App\Models\ModeloPermiso;

class VisualizarProducto extends BaseController
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
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 11 );
                if( !empty( $perfil ) )
                {
                    $db = \Config\Database::connect();
                    $sql = 'SELECT p.idproducto, p.producto, p.descripcionproducto, p.stock, p.preciounidad, c.categoria as categoria, m.marca as marca';
                    $sql .= ' FROM producto AS p INNER JOIN categoria AS c ON p.idcategoria = c.idcategoria';
                    $sql .= ' INNER JOIN marca AS m ON p.idmarca = m.idmarca where estadoproducto = 1';
                    $model = $db->query($sql);
                    $datos["Resultado"] = $model->getResultArray();
                    echo $this->use_layout('visualizar_producto', $datos);
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

    public function getupdate($id) 
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
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 11 );
                if( !empty( $perfil ) )
                {
                    helper('form');
                    $categorias = new Categoriaproducto();
                    $categorias = $categorias->index();
                    $marcas = new Marcaproducto();
                    $marcas = $marcas->index();
                    $lineas = new Lineaproducto();
                    $lineas = $lineas->index();
                    $productos = new ProductoModel();
                    
                    $data['producto'] = $productos->where('estadoproducto', 1)->find($id);
                    $data['categorias'] = $categorias;
                    $data['marcas'] = $marcas;
                    $data['lineas'] = $lineas;        
                    echo $this->use_layout('modificar_producto', $data);
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

    public function getupdatever($id) 
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
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 11 );
                if( !empty( $perfil ) )
                {
                    helper('form');
                    $productos = new ProductoModel();
                    $categorias = new Categoriaproducto();
                    $marcas = new Marcaproducto();
                    $lineas = new Lineaproducto();
                    
                    $producto = $productos->where('estadoproducto', 1)->find($id);
                    $categoria = $categorias->traerPorId($producto['idcategoria']);
                    $marca = $marcas->traerPorId($producto['idmarca']);
                    $linea = $lineas->traerPorId($producto['idlinea']);

                    $data['producto'] = $producto;
                    $data['categoria'] = $categoria;
                    $data['marca'] = $marca;
                    $data['linea'] = $linea;
                    echo $this->use_layout('ver_producto', $data);
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
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 11 );
                if( !empty( $perfil ) )
                {
                    $request = \Config\Services::request();
                    $model = new ProductoModel();
                    $datos = [
                        'producto' => $request->getPost('producto'),
                        'idcategoria' => $request->getPost('idcategoria'),
                        'idmarca' => $request->getPost('idmarca'),
                        'descripcionproducto' => $request->getPost('descripcionproducto'),
                        'stock' => $request->getPost('stock'),
                        'idlinea' => $request->getPost('idlinea'),
                        'preciounidad' => $request->getPost('preciounidad'),
                        'rutafoto' => $request->getPost('rutafoto'),
                    ];
                    $model->update($id, $datos);
                    return redirect()->to(base_url() . '/index.php/VisualizarProducto');
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

    public function delete($id) {
        try
        {
            if( empty( $_SESSION[ 'nombre' ] ) )
            {
                return redirect()->to( base_url() . '/Login' );
            }
            else
            {
                $model = new ModeloPermiso();
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 11 );
                if( !empty( $perfil ) )
                {
                    $db = \Config\Database::connect();
                    $model2 = $db->query("UPDATE producto SET estadoproducto = 0 WHERE idproducto = $id AND estadoproducto = 1");
                    return redirect()->to(base_url() . '/index.php/VisualizarProducto');
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
