<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProveedorModel;
use App\Controllers\TipoDocumento;
use App\Models\ModeloPermiso;
use App\Models\ModeloProveedor;

class VisualizarProveedor extends BaseController
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
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 10 );
                if( !empty( $perfil ) )
                {
                    $model = new ModeloProveedor();
                    $datos[ 'Resultado' ] = $model->traerProveedores();
                    echo $this->use_layout( 'visualizar_proveedor', $datos );
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
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 10 );
                if( !empty( $perfil ) )
                {
                    helper('form');
                    $tipodocumento = new TipoDocumento();
                    $tipodocumento = $tipodocumento->index();
                    $data['tipodocumento'] = $tipodocumento;

                    $proveedor = new ProveedorModel();
                    $data['proveedor'] = $proveedor->where('estadoproveedor', 1)->find($id);

                    echo $this->use_layout('modificar_proveedor', $data);
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
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 10 );
                if( !empty( $perfil ) )
                {
                    $request = \Config\Services::request();
                    $model = new ProveedorModel();
                    $datos = [
                        'razonsocial' => $request->getPost('proveedor'),
                        'idtipodocumento' => $request->getPost('idtipodocumento'),
                        'documento' => $request->getPost('documento'),
                        'direccion' => $request->getPost('direccion'),
                        'email' => $request->getPost('email'),
                        'telefono_cel' => $request->getPost('telefono_cel'),
                    ];
                    $model->update($id, $datos);
                    return redirect()->to(base_url() . '/index.php/VisualizarProveedor');
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
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 10 );
                if( !empty( $perfil ) )
                {
                    $db = \Config\Database::connect();
                    $model2 = $db->query("UPDATE proveedor SET estadoproveedor = 0 WHERE idproveedor = $id AND estadoproveedor = 1");
                    return redirect()->to(base_url() . '/index.php/VisualizarProveedor');
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
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 10 );
                if( !empty( $perfil ) )
                {
                    helper('form');
                    $proveedor = new ProveedorModel();
                    $tipodocumento = new TipoDocumento(); 
                    $tipodocumento = $tipodocumento->index();
                    $data['tipodocumento'] = $tipodocumento;
                    $proveedor = $proveedor->where('estadoproveedor', 1)->find($id);

                    $data['proveedor'] = $proveedor;

                    echo $this->use_layout('ver_proveedor', $data);
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
