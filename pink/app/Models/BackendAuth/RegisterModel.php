<?php  
namespace App\Models\Auth;

use CodeIgniter\Model; 
  
class RegisterModel extends Model
{
	function __construct()
	{
		$this->db = \Config\Database::connect();
	}

	public function createUser($data)
	{
		return $this->db->table('users')->insert($data);
	}

	public function isUnique($key, $value)
	{
		return $this->db->query("SELECT COUNT(*) as total_users FROM users where $key = '$value'")->getRow()->total_users;
	}
}