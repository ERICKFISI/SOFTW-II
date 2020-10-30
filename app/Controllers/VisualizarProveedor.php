<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProveedorModel;
use App\Controllers\TipoDocumento;

class VisualizarProveedor extends BaseController
{
    public function index()
    {	
        $db = \Config\Database::connect();
        $sql = 'SELECT p.*';
        $sql .= ' FROM proveedor AS p ';
        $sql .= ' where p.estadoproveedor = 1';
        $model = $db->query($sql);
        $datos["Resultado"] = $model->getResultArray();
        echo $this->use_layout('visualizar_proveedor', $datos);
    }

    public function getupdate($id) 
    {
        helper('form');
        $tipodocumento = new TipoDocumento();
        $tipodocumento = $tipodocumento->index();
        $data['tipodocumento'] = $tipodocumento;

        $proveedor = new ProveedorModel();
        $data['proveedor'] = $proveedor->where('estadoproveedor', 1)->find($id);

        echo $this->use_layout('modificar_proveedor', $data);
    }
        public function update($id) {
        $request = \Config\Services::request();
        $model = new ProveedorModel();
        if ($_POST['idtipodocumento']==1) {
             $razon='nombrecomercial';
           }else{
            $razon='razonsocial';
           }

        $datos = [
            $razon => $request->getPost('proveedor'),
            'idtipodocumento' => $request->getPost('idtipodocumento'),
            'documento' => $request->getPost('documento'),
            'direccion' => $request->getPost('direccion'),
            'email' => $request->getPost('email'),
            'telefono_cel' => $request->getPost('telefono_cel'),
        ];
        $model->update($id, $datos);
        return redirect()->to(base_url() . '/index.php/VisualizarProveedor');
    }


    public function delete($id) {
        $db = \Config\Database::connect();
        $model2 = $db->query("UPDATE proveedor SET estadoproveedor = 0 WHERE idproveedor = $id AND estadoproveedor = 1");
        return redirect()->to(base_url() . '/index.php/VisualizarProveedor');
    }

    public function getupdatever($id) 
    {
        helper('form');
        $proveedor = new ProveedorModel();
        $tipodocumento = new TipoDocumento(); 
        $tipodocumento = $tipodocumento->index();
        $data['tipodocumento'] = $tipodocumento;
        $proveedor = $proveedor->where('estadoproveedor', 1)->find($id);

        $data['proveedor'] = $proveedor;

        echo $this->use_layout('ver_proveedor', $data);
    }


    
}
