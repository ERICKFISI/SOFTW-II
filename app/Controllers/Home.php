<?php

namespace App\Controllers;

use App\Controllers\perfil;
use App\Controllers\Categoriaproducto;
use App\Controllers\Marcaproducto;
use App\Controllers\TipoDocumento;
use App\Models\ModeloPermiso;

class Home extends BaseController {

    public function index() {
        echo view('header');
        echo view('login');
    }

    public function registrarusuario() {

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
                    $perfiles = new perfil();
                    $perfiles = $perfiles->index();
                    $data['perfiles'] = $perfiles;
                    echo $this->use_layout('registrar_usuario', $data);
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

    public function registrarproducto() {

        $categorias = new Categoriaproducto();
        $categorias = $categorias->index();
        $data['categorias'] = $categorias;
        $marcas = new Marcaproducto();
        $marcas = $marcas->index();
        $lineas = new Lineaproducto();
        $lineas = $lineas->index();

        $data['marcas'] = $marcas;
        $data['lineas'] = $lineas;
        echo $this->use_layout('registrar_producto', $data);
    }

    public function registrarmarca()
    {
        echo $this->use_layout('registrar_marca');
    }


    public function registrarproveedor() {

        $tipodocumento = new TipoDocumento();
        $tipodocumento = $tipodocumento->index();
        $data['tipodocumento'] = $tipodocumento;

        echo $this->use_layout('registrar_proveedor', $data);
    }
    //--------------------------------------------------------------------
}
