<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ModeloSerieComprobante;
use App\Models\ModeloPermiso;
use App\Models\ComprobanteModel;

class SerieComprobante extends BaseController
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
				$perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 7 );
				if( !empty( $perfil ) )
				{
					$model = new ModeloSerieComprobante();
					$datos[ 'seriecomprobantes' ] = $model -> traerSerieComprobante();
					echo $this->use_layout( 'visualizar_seriecomprobante', $datos );
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
	
	public function form()
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
				$perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 8 );
				if( !empty( $perfil ) )
				{
					$model = new ComprobanteModel();
					$data[ 'comprobantes' ]	= $model->traerComprobantes();
					echo $this->use_layout( 'registrar_seriecomprobante', $data );
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
				$perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 8 );
				if( !empty( $perfil ) )
				{
					$model = new ComprobanteModel();
					$data[ 'comprobantes' ]	= $model->traerComprobantes();
					$model = new ModeloSerieComprobante();
					$data[ 'seriecomprobante' ] = $model -> find( $id );
                    $data["tseries"] = json_encode($model->traerSerieComprobante(), true);
					echo $this->use_layout( 'modificar_seriecomprobante', $data );
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

	public function create()
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
				$perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 8 );
				if( !empty( $perfil ) )
				{
					if( $_SERVER[ 'REQUEST_METHOD' ] == "POST" )
					{
						$model = new ModeloSerieComprobante();
						$seriecomprobante = $model -> where( 'idcomprobante', $_POST[ 'idcomprobante' ] )
						-> where( 'seriesc', $_POST[ 'seriesc' ] ) -> findAll();
						if( empty( $seriecomprobante[ '0' ] ) )
						{
							$datos = array(
									'idcomprobante' => $_POST[ 'idcomprobante' ],
									'seriesc' => $_POST[ 'seriesc' ],
									'correlativosc' => $_POST[ 'correlativosc' ]
								);
							$model = new ModeloSerieComprobante();
							$model->insert($datos);
							return redirect()->to( base_url() . '/SerieComprobante' );
						}
						else
						{
							var_dump($seriecomprobante);die;
							return redirect()->to( base_url() . '/SerieComprobante' );
						}
					}
					else
					{
						echo "Ya hay un cliente registrado con esa información";
						return redirect()->to( base_url() . '/Clientes' );
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

	public function update( $id )
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
				$perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 8 );
				if( !empty( $perfil ) )
				{
					if( $_SERVER[ 'REQUEST_METHOD' ] == "POST" )
					{
						$model = new ModeloSerieComprobante();
						$seriecomprobante = $model -> where( 'idcomprobante', $_POST[ 'idcomprobante' ] ) -> where( 'seriesc', $_POST[ 'seriesc' ] ) -> findAll();
						if( empty( $seriecomprobante[ '0' ] ) )
						{
							$datos = array(
									'idcomprobante' => $_POST[ 'idcomprobante' ],
									'seriesc' => $_POST[ 'seriesc' ]
								);
							$seriecomprobante = $model -> update( $id , $datos );
							return redirect()->to( base_url() . '/SerieComprobante' );
						}
						else
						{
							return redirect()->to( base_url() . '/SerieComprobante' );
						}
					}
					else
					{
						echo "Ya hay una Serie registrado con esa información";
						return redirect()->to( base_url() . '/SerieComprobante' );
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

	public function delete( $id )
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
				$perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 7 );
				if( !empty( $perfil ) )
				{
					$model = new ModeloClientes();
					$datos = array(
						'estadocliente' => 0
					);
					$clientes = $model -> where( 'estadocliente', 1 ) -> find( $id );
					if ( !is_null( $clientes ) && is_numeric( $id ) )
					{
						$clientes = $model -> update( $id, $datos );
						return redirect()->to( base_url() . '/Clientes' );
					}
					else
					{
						return redirect()->to( base_url() . '/Clientes' );
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


    public function traerSeries()
    {
        $modelo = new ModeloSerieComprobante();

        $series = $modelo->traerSerieComprobante();
        return json_encode($series, true);
    }


}
