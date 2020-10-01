<?php 

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ProductoModel;
use App\Models\CategoriaModel;
use App\Models\MarcaModel;


class Producto extends Controller{

	/*public function index(){

	}*/

	public function create(){
		
		if(isset($_POST['idcategoria'], $_POST["idmarca"])){   #RECEPCION FORULARIO
			
			$categoria = new Categoriaproducto();
            $marca = new Marcaproducto();

			$id_categoria = $_POST['idcategoria'];	
			$existe_categoria = $categoria->validarCategoria($id_categoria);

			$id_marca = $_POST['idmarca'];	
			$existe_marca = $marca->validarMarca($id_marca);

			$data = array('producto' => $_POST['producto'], 
                          'idcategoria' => $_POST['idcategoria'],
                          'idmarca' => $_POST['idmarca'],
                          'idlinea' => $_POST['idlinea'],
                          'descripcionproducto' => $_POST['descripcionproducto'],
                          'stock' => $_POST['stock'],
                          'preciounidad' => $_POST['preciounidad'],
                          'rutafoto' => $_POST['rutafoto']);

            // Modicamos la ruta foto -- Las fotos de los productos iran en public/productos
            // TODO: No reconoce el id "rutafoto" el cual asi esta en el name del input
            /*
            $ruta = "public/productos/".$_FILES["rutafoto"]["name"];
            $ruta2 = "../../public/productos/".$_FILES["rutafoto"]["name"];
            move_upload_file($_FILES["rutafoto"]["tmp_name"], $ruta2);

            $data["rutafoto"] = $ruta;
            */
            
			$mensaje;

			if($existe_categoria == 0){        #categoria no encontrado
				$mensaje = 'Categoria invalido';
				return $mensaje; die;
			}

			if($existe_marca == 0){        #marca no encontrado
				$mensaje = 'Marca invalido';
				return $mensaje; die;
			}

			$producto_model = new ProductoModel();
            
            $producto = $producto_model->insert($data);
            $mensaje = 'Producto añadido';
			
			return redirect()->to( base_url().'/index.php/VisualizarProducto'); 

		}#fin IF

		else{
			$data = 'ERROR-404';
			return redirect()->to( base_url().'/index.php/VisualizarProducto'); 

		}#fin ELSE
	} 

	private function contar($input,$max_length){
		$length = strlen($input);
		$data;

		if($length != $max_length){
			$data = array('valor' => false, 'mensaje' => ' debe tener un tamaño de '.$max_length.		  ' caracteres');
		}
		else{
			$data = array('valor' => true);
		}
		return $data;
	}
			
}#fin CLASS
