<?php

namespace App\Models\Secure;

use CodeIgniter\Model;

class UserModel extends Model
{
	function __construct()
	{
		$this->db = \Config\Database::connect();
	}

	public function getUsers($filter = [], $start = '', $export = '', $limit = PAGE_LIMIT)
	{
		$builder = $this->db->table('users')->select('id, name, email, username, mobile, thumbnail, status, created_at, updated_at');
		if (!empty($filter['name'])) {
			$builder->like('name', $filter['name']);
		}
		if (!empty($filter['email'])) {
			$builder->where('email', $filter['email']);
		}
		if (!empty($filter['status'])) {
			$builder->where('status', $filter['status']);
		}
		if ($export != 'Y') {
			$builder->limit($limit, $start);
		}
		return $builder->get()->getResult();
	}

	public function getUser($id)
	{
		$builder = $this->db->table('users')->where('id', $id)->get()->getRow();
		return $builder;
	}

	public function updateUser($id, $data)
	{
		return $this->db->table('users')->where('id', $id)->update($data);
	}

	public function remove($id)
	{
		return $this->db->table('users')->where('id', $id)->delete();
	}
}