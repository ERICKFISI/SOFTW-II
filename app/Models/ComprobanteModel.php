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
	protected $allowedFields = ['idcomprobante','comprobante','estadocomprobante'];
}