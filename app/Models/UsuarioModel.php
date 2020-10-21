<?php 

namespace App\Models;
use CodeIgniter\Model;

class UsuarioModel extends Model{

	protected $table = 'usuario';
	protected $primaryKey = 'idusuario';
	protected $returnType = 'array';
	protected $allowedFields = ['nombreusuario','nombre','contrasena',
							   'dni','telefono','idperfil'];

    public function traerUsuarios()
    {
        return $this->db->table("usuario u")
                ->where("u.estado", 1)
                ->join("perfil p", "p.idperfil = u.idperfil")
                ->get()->getResultArray();
    }

    public function traerUsuarioPorId($id)
    {
        return $this->db->table("usuario u")
                ->where("u.estado", 1)
                ->where("u.idusuario", $id)                
                ->join("perfil p", "p.idperfil = u.idperfil")
                ->get()->getResultArray();
    }
}
