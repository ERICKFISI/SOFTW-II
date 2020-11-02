<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Controllers\perfil;
use App\Models\MarcaModel;
use App\Models\ModeloPermiso;


class VisualizarMarca extends BaseController
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
				$perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 14 );
				if( !empty( $perfil ) )
				{
					$model = new MarcaModel();
					$datos ['marca'] = $model -> where( 'estado', 1 ) -> findAll();
					echo $this->use_layout('visualizar_marca', $datos);
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

		public function show( $id )
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
				$perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 14 );
				if( !empty( $perfil ) )
				{
					if (is_numeric($id))
					{
						$model = new MarcaModel();
						$datos ['marca'] = $model -> where( 'estado', 1 ) -> find( $id );
						if(empty($datos))
						{
							
						}
					}
					else
					{
						echo "Error";
					}
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
				$perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 14 );
				if( !empty( $perfil ) )
				{
					helper('form');
			        $productos = new MarcaModel();
			        
			        $data['marca'] = $productos->where('estado', 1)->find($id);
			        echo $this->use_layout('modificar_marca', $data);
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
				$perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 14 );
				if( !empty( $perfil ) )
				{
					$request = \Config\Services::request();
			        $model = new MarcaModel();
			        $datos = [
			            'marca' => $request->getPost('marca'),
			        ];
			        $model->update($id, $datos);
			        return redirect()->to(base_url() . '/index.php/VisualizarMarca');
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
				$perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 14 );
				if( !empty( $perfil ) )
				{
					$db = \Config\Database::connect();
			        $model2 = $db->query("UPDATE marca SET estado = 0 WHERE idmarca = $id AND estado = 1");
			        return redirect()->to(base_url() . '/index.php/VisualizarMarca');
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
