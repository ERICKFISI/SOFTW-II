<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ModeloPerfil;
use App\Models\ModeloPermiso;

class Registrarperfil extends BaseController
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
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 17 );
                if( !empty( $perfil ) )
                {
                    $bd = \Config\Database::connect();
                    $sql = "SELECT * FROM modulo where NOT( idmodulopadre = 0 )";
                    $consulta = $bd->query($sql);
                    $registros = $consulta->getResult();
                    $data = ["registros" => $registros];
                    echo $this->use_layout('registrar_perfil',$data);
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
                $perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 17 );
                if( !empty( $perfil ) )
                {
                    $bd = \Config\Database::connect();
                    $consulta = $bd->query("SELECT * FROM perfil WHERE nombre = ?", [$_POST["nombreperfil"], ]);
                    $perfil = $consulta->getRow();
                    if (isset($perfil))
                    {
                        return json_encode(["Estado" => 404, "Detalles" => "Este perfil ya existe"]);
                    }
                    $bd->query("INSERT INTO perfil (nombre) VALUES (?)", [$_POST["nombreperfil"], ]);
                    if ($bd->affectedRows() != 1)
                    {
                        // Error al ingresar - hacia donde va a ir?
                        return json_encode(["Estado" => 404, "Detalles" => "No se ingreso el dato"]);
                    }
                    // Obtenemos el idperfil recien creado
                    $consulta = $bd->query("SELECT * FROM perfil WHERE nombre = ?", [$_POST["nombreperfil"], ]);
                    $perfil = $consulta->getRow();

                    foreach ($_POST["checks"] as $seleccion)
                    {
                        if (isset($seleccion) && !empty($seleccion))
                        {
                            $bd->query("INSERT INTO permiso (idmodulo, idperfil) VALUES (?, ".$perfil->idperfil.")", [$seleccion, ]);
                        }
                    }
                    // Aqui hacia donde va a ir?
                    return redirect()->to( base_url() . '/Visualizarperfil' );
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
    
    // Funcion para traer los perfiles con ajax
    public function traerPerfiles()
    {
        $modelo = new ModeloPerfil();
        
        $perfiles = $modelo->traerPerfiles();
        return json_encode($perfiles, true);
    }

}
