<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProductoModel;

class VisualizarProducto extends BaseController
{
    public function index()
    {	
        $db = \Config\Database::connect();
        $sql = 'SELECT p.idproducto, p.producto, p.descripcionproducto, p.stock, p.preciounidad, c.categoria as categoria, m.marca as marca';
        $sql .= ' FROM producto AS p INNER JOIN categoria AS c ON p.idcategoria = c.idcategoria';
        $sql .= ' INNER JOIN marca AS m ON p.idmarca = m.idmarca where estadoproducto = 1';
        $model = $db->query($sql);
        $datos["Resultado"] = $model->getResultArray();
        echo $this->use_layout('visualizar_producto', $datos);
    }

    public function getupdate($id) 
    {
        helper('form');
        $categorias = new Categoriaproducto();
        $categorias = $categorias->index();
        $marcas = new Marcaproducto();
        $marcas = $marcas->index();
        $productos = new ProductoModel();
        
        $data['producto'] = $productos->where('estadoproducto', 1)->find($id);
        $data['categorias'] = $categorias;
        $data['marcas'] = $marcas;
        echo $this->use_layout('modificar_producto', $data);
    }

    public function update($id) {
        $request = \Config\Services::request();
        $model = new ProductoModel();
        $datos = [
            'producto' => $request->getPost('producto'),
            'idcategoria' => $request->getPost('idcategoria'),
            'idmarca' => $request->getPost('idmarca'),
            'descripcionproducto' => $request->getPost('descripcionproducto'),
            'stock' => $request->getPost('stock'),
            'preciounidad' => $request->getPost('preciounidad'),
            'rutafoto' => $request->getPost('rutafoto'),
        ];
        $model->update($id, $datos);
        return redirect()->to(base_url() . '/index.php/VisualizarProducto');
    }

    public function delete($id) {
        $db = \Config\Database::connect();
        $model2 = $db->query("UPDATE producto SET estadoproducto = 0 WHERE idproducto = $id AND estadoproducto = 1");
        return redirect()->to(base_url() . '/index.php/VisualizarProducto');
    }
    
}
