<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Controllers\perfil;
use App\Models\CategoriaModel;

class VisualizarCategoria extends BaseController
{
		public function index()
		{	
			$model = new CategoriaModel();
			$datos ['categoria'] = $model -> where( 'estadocategoria', 1 ) -> findAll();
			 echo $this->use_layout('visualizar_categoria', $datos);
		}

		public function getupdate( $id )
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

		public function update( $id )
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

		public function show()
		{
			$datos['menu'] = 0;
			echo $this -> use_layout( 'registrar_categoria', $datos);
		}

		public function create()
		{
			
				$model = new CategoriaModel();
				$data = array(
						'categoria' => $_POST[ 'categoria' ]
					);
				$model -> insert( $data );
				
				return redirect()->to(base_url() . '/index.php/visualizarcategoria');
		}

		public function delete( $id )
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

}