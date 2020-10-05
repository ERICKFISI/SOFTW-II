<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 * 
 */
class DetIngProModel extends Model
{
	protected $table = 'detingpro';
	protected $primaryKey = 'iddetingpro';
	protected $returnType = 'array';
	protected $allowedFields = ['iddetingpro','idingreso','idproducto', 'cantidadingreso', 'preciounidad','estadodetingpro'];
}