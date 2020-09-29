<?php 

namespace App\Models;
use CodeIgniter\Model;

class ProductoModel extends Model{

	protected $table = 'producto';
	protected $primaryKey = 'idproducto';
	protected $returnType = 'array';
	protected $allowedFields = ['idcategoria','producto','idmarca', 'stock', 'preciounidad',
							   'descripcionproducto','rutafoto','estadoproducto'];

}
