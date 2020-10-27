<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 * 
 */
class ComprobanteModel extends Model
{
	protected $table = 'comprobante';
	protected $primaryKey = 'idcomprobante';
	protected $returnType = 'array';
	protected $allowedFields = ['idcomprobante','comprobante','correlativo',
                                'estadocomprobante', 'contador'];

    public function traerComprobantes()
    {
        return $this->db->table("comprobante c")
                ->where("c.estadocomprobante", 1)
                ->get()->getResultArray();
    }

    public function traerComprobantePorId($id)
    {
        return $this->db->table("comprobante c")
                ->where("c.estadocomprobante", 1)                
                ->where("c.idcomprobante", $id)
                ->get()->getResultArray();
    }
    
}
