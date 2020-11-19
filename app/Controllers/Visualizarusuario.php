<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Controllers\perfil;
use App\Models\UsuarioModel;
use App\Models\ModeloPermiso;

class VisualizarUsuario extends BaseController {

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
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 18 );
                if( !empty( $perfil ) )
                {
                    $db = \Config\Database::connect();
                    $model = $db->query('SELECT p.nombre AS nombreperfil, u.idusuario, u.nombreusuario, u.nombre, u.dni, u.telefono,u.estado AS estadousuario, p.estado AS estadoperfil FROM perfil AS p INNER JOIN usuario AS u ON p.idperfil = u.idperfil');
                    $datos["Resultado"] = $model->getResultArray();
                    echo $this->use_layout('visualizar_usuario', $datos);
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
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 18 );
                if( !empty( $perfil ) )
                {
                    helper('form');
                    $perfiles = new perfil();
                    $perfiles = $perfiles->index();
                    $usuarios = new UsuarioModel();
                    $data['usuarios'] = $usuarios->where('estado', 1)->find($id);
                    $data['perfiles'] = $perfiles;
                    $data["tusuarios"] = json_encode($usuarios->traerUsuarios(), true);
                    echo $this->use_layout('modificar_usuario', $data);
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
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 18 );
                if( !empty( $perfil ) )
                {
                    $request = \Config\Services::request();
                    $model = new UsuarioModel();
                    $datos = [
                        'nombreusuario' => $request->getPost('nombreusuario'),
                        'contrasena' => $request->getPost('contrasena'),
                        'nombre' => $request->getPost('nombre'),
                        'dni' => $request->getPost('dni'),
                        'telefono' => $request->getPost('telefono'),
                        'idperfil' => $request->getPost('idperfil'),
                    ];
                    $model->update($id, $datos);
                    return redirect()->to(base_url() . '/index.php/VisualizarUsuario');
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
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 18 );
                if( !empty( $perfil ) )
                {
                    $db = \Config\Database::connect();
                    $model2 = $db->query("UPDATE usuario SET estado = 0 WHERE idusuario = $id AND estado = 1");
                    $model = $db->query('SELECT p.nombre AS nombreperfil, u.idusuario, u.nombreusuario, u.nombre, u.dni, u.telefono,u.estado AS estadousuario, p.estado AS estadoperfil FROM perfil AS p INNER JOIN usuario AS u ON p.idperfil = u.idperfil');
                    $datos["Resultado"] = $model->getResultArray();
                    return redirect()->to(base_url() . '/index.php/VisualizarUsuario');
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

    public function traerUsuarios()
    {
        $modelo = new UsuarioModel();

        $usuarios = $modelo->traerUsuarios();
        return json_encode($usuarios, true);
    }


}
