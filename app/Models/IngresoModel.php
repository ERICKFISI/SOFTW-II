<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 * 
 */
class IngresoModel extends Model
{
	protected $table = 'ingreso';
	protected $primaryKey = 'idingreso';
	protected $returnType = 'array';
	protected $allowedFields = ['idingreso','idtipoingreso','idcomprobanteingreso', 'fechaingreso', 'totalingreso','descripcioningreso','estadoingreso'];
}