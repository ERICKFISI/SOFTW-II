<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ModeloPermiso;
class Test extends BaseController
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
				$perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 18 );
				if( !empty( $perfil ) )
				{
					echo "hola";
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