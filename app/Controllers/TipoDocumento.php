<?php 

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\TipoDocumentoModel;

class TipoDocumento extends BaseController{

	public function index(){
		$tipodocumento_model = new TipoDocumentoModel();
		$tipodocumento = $tipodocumento_model->where('estadotipodocumento',1)->findAll();
		$data;
		if(!is_null($tipodocumento)){
			$data = $tipodocumento;
			}
			else{
				$data = array('No se encontraron tipo de documento');
			}
			return $data;
		}


}

