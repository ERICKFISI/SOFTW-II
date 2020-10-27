<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeloVentas extends Model
{
    protected $table = "venta";
    protected $primaryKey = 'idventa';
    protected $returnType = 'array';
    protected $allowedFields = ['idcliente', 'idusuario', 'idcomprobante', 'fechaventa',
                                'direccioncliente', 'totalventa', 'correlativo', 'estadoventa'];

    public function traerVentas()
    {
        return $this->db->table("venta v")
                ->join("cliente c", "v.idcliente = c.idcliente")
                ->join("usuario u", "v.idusuario = u.idusuario")
                ->join("comprobante co", "v.idcomprobante = co.idcomprobante")                
                ->get()->getResultArray();
    }

    public function traerVentaPorId($id)
    {
        return $this->db->table("venta v")
                ->where("v.idventa", $id)
                ->join("cliente c", "v.idcliente = c.idcliente")
                ->join("usuario u", "v.idusuario = u.idusuario")
                ->join("comprobante co", "v.idcomprobante = co.idcomprobante")                
                ->get()->getResultArray();
    }

    public function traerDetDeVenta($id)
    {
        return $this->db->table("detvenpro v")
                ->where("v.idventa", $id)
                ->where("v.estadodetvenpro", 1)                
                ->join("producto c", "v.idproducto = c.idproducto")
                ->get()->getResultArray();
        
    }

}
