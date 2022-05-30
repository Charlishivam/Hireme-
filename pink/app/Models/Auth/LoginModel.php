<?php  
namespace App\Models\Auth;

use CodeIgniter\Model; 
  
class LoginModel extends Model
{
	function __construct()
	{
		$this->db = \Config\Database::connect();
	}

	public function checkUser($username)
	{
		return $this->db->table('users')
			->select('id, name, username, email, mobile, status, password')
			->where('email', $username)
			->orWhere('username', $username)
			->get()->getRow();
	}

	public function checkAccount($username)
	{
		return $this->db->table('users')
			->select('id, name, username, email, mobile, status, password')
			->where('email', $username)
			->get()->getRow();
	}

	public function updatePassword($id, $data)
	{
		return $this->db->table('users')
			->where('id', $id)
			->update($data);
	}

}