<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Controllers\perfil;
use App\Models\CategoriaModel;
use App\Models\ModeloPermiso;

class VisualizarCategoria extends BaseController
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
					$perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 15 );
					if( !empty( $perfil ) )
					{
						$model = new CategoriaModel();
						$datos ['categoria'] = $model -> where( 'estadocategoria', 1 ) -> findAll();
						 echo $this->use_layout('visualizar_categoria', $datos);
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

		public function getupdate( $id )
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
					$perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 15 );
					if( !empty( $perfil ) )
					{
						if (is_numeric( $id ))
						{
							$model = new CategoriaModel();
							$datos [ 'categoria' ] = $model -> where( 'estadocategoria', 1 ) -> find( $id );
							if( !empty( $datos ) )
							{
								echo $this -> use_layout( 'modificar_categoria', $datos );
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
					$perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 15 );
					if( !empty( $perfil ) )
					{
						if (!empty( $id ))
						{
							$model = new CategoriaModel();
							$datos = $model -> where( 'estadocategoria', 1 ) -> find( $id );
							if( !empty( $datos ) )
							{
								$data = array(
									'categoria' => $_POST[ 'categoria' ]
								);
								$model -> update( $id, $data );
							}
						}
						else
						{
							echo "Error";
						}
						return redirect()->to(base_url() . '/index.php/visualizarcategoria');
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

		public function show()
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
				$perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 15 );
				if( !empty( $perfil ) )
				{
					$datos['menu'] = 0;
					echo $this -> use_layout( 'registrar_categoria', $datos);
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
						$perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 15 );
						if( !empty( $perfil ) )
						{
							$model = new CategoriaModel();
							$data = array(
									'categoria' => $_POST[ 'categoria' ]
								);
							$model -> insert( $data );
							
							return redirect()->to(base_url() . '/index.php/visualizarcategoria');
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
				$perfil = $model->ComprobarPermisos( $_SESSION[ 'idperfil' ], 15 );
				if( !empty( $perfil ) )
				{
					if (!empty( $id ))
					{
						$model = new CategoriaModel();
						$datos = $model -> where( 'estadocategoria', 1 ) -> find( $id );
						if( !empty( $datos ) )
						{
							$data = array(
								'estadocategoria' => 0 
							);
							$model -> update( $id, $data );
						}
					}
					else
					{
						echo "Error";
					}
					return redirect()->to(base_url() . '/index.php/visualizarcategoria');
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