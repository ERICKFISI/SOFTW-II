<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 * 
 */
class TipoIngresoModel extends Model
{
	protected $table = 'tipoingreso';
	protected $primaryKey = 'idtipodocumento';
	protected $returnType = 'array';
	protected $allowedFields = ['idtipodocumento','tipodocumento','estadotipodocumento'];
}