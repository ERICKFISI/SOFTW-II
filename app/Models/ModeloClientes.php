<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeloClientes extends Model
{
    protected $table = "cliente";
    protected $primaryKey = 'idcliente';
    protected $returnType = 'array';
    protected $allowedFields = ['documento', 'razonsocial', 'idcomprobante', 'nombrecomercial',
                                'direccion', 'email', 'telefono_cel', 'idtipodocumento', 'estadocliente'];

    public function traerClientes()
    {
        return $this->db->table("cliente c")
                ->where("c.estadocliente", 1)
                ->join("tipodocumento t", "c.idtipodocumento = t.idtipodocumento")
                ->get()->getResultArray();
    }

    public function traerClientePorId($id)
    {
        return $this->db->table("cliente c")
                ->where("c.estadocliente", 1)
                ->where("c.idcliente", $id)                
                ->join("tipodocumento t", "c.idtipodocumento = t.idtipodocumento")
                ->get()->getResultArray();
    }
    public function traerTipoDocumentos()
    {
        return $this -> db -> table( 'tipodocumento' )
        -> where( 'estadotipodocumento', 1 )
        -> get() -> getResultArray();
    }
}
