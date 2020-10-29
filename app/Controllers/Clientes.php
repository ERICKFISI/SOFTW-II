<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ModeloClientes;
use App\Models\TipoDocumento;

class Clientes extends BaseController
{
	public function index()
	{
		$model = new ModeloClientes();
		$datos[ 'clientes' ] = $model->traerClientes();
		echo $this->use_layout( 'clientes', $datos );
	}
	
	public function form()
	{
		$model = new ModeloClientes();
		$datos[ 'tipodocumentos' ] = $model -> traerTipoDocumentos();
		echo $this->use_layout( 'registrar_cliente', $datos );
	}

	public function show( $id )
	{
		$model = new ModeloClientes();
		$datos[ 'tipodocumentos' ] = $model -> traerTipoDocumentos();
		$datos[ 'cliente' ] = $model -> traerClientePorId( $id );
		echo $this->use_layout( 'modificar_cliente', $datos );
	}

	public function create()
	{
		if( $_SERVER[ 'REQUEST_METHOD' ] == "POST" )
		{
			$model = new ModeloClientes();
			$cliente = $model -> where( 'estadocliente', 1 ) -> where( 'documento', $_POST[ 'documento' ] ) -> findAll();
			if( !isset( $cliente[ '0' ] ) )
			{
				$datos = array(
						'idtipodocumento' => $_POST[ 'idtipodocumento' ],
						'documento' => $_POST[ 'documento' ],
						'razonsocial' => $_POST[ 'razonsocial' ],
						'direccion' => $_POST[ 'direccion' ],
						'email' => $_POST[ 'email' ],
						'telefono_cel' => $_POST[ 'telefono_cel' ]
					);
				$cliente = $model -> insert( $datos );
				return redirect()->to( base_url() . '/Clientes' );
			}
			else
			{
				return redirect()->to( base_url() . '/Clientes' );
			}
		}
		else
		{
			echo "Ya hay un cliente registrado con esa información";
			return redirect()->to( base_url() . '/Clientes' );
		}
	}

	public function update( $id )
	{
		if( $_SERVER[ 'REQUEST_METHOD' ] == "POST" )
		{
			$model = new ModeloClientes();
			$cliente = $model -> where( 'estadocliente', 1 ) -> where( 'documento', $_POST[ 'documento' ] ) -> findAll();
			if( isset( $cliente[ '0' ] ) )
			{
				$datos = array(
						'idtipodocumento' => $_POST[ 'idtipodocumento' ],
						'documento' => $_POST[ 'documento' ],
						'razonsocial' => $_POST[ 'razonsocial' ],
						'direccion' => $_POST[ 'direccion' ],
						'email' => $_POST[ 'email' ],
						'telefono_cel' => $_POST[ 'telefono_cel' ]
					);
				$cliente = $model -> update( $id , $datos );
				return redirect()->to( base_url() . '/Clientes' );
			}
			else
			{
				return redirect()->to( base_url() . '/Clientes' );
			}
		}
		else
		{
			echo "Ya hay un cliente registrado con esa información";
			return redirect()->to( base_url() . '/Clientes' );
		}
	}

	public function delete( $id )
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

}