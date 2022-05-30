<?php

namespace App\Models\Secure;

use CodeIgniter\Model;

class TagModel extends Model
{
	function __construct()
	{
		$this->db = \Config\Database::connect();
	}

	public function getTag($filter = [], $start = '', $export = '', $limit = PAGE_LIMIT)
	{
		$builder = $this->db->table('tag')->select('id, name, status, description, created_at,');
		if (!empty($filter['name'])) {
			$builder->like('name', $filter['name']);
		}
		if (!empty($filter['status'])) {
			$builder->where('status', $filter['status']);
		}
		if ($export != 'Y') {
			$builder->limit($limit, $start);
		}
		$builder->orderBy('id', 'DESC');
		return $builder->get()->getResult();
	}

	public function saveTag($data)
	{
		// echo '<pre>';print_r($data);die;
		return $this->db->table('tag')->insert($data);
	}

	public function updateTag($id, $data)
	{
		return $this->db->table('tag')->where('id', $id)->update($data);
	}

	public function remove($id)
	{
		return $this->db->table('tag')->where('id', $id)->delete();
	}
	
	public function getTagData($id)
	{
		$builder = $this->db->table('tag')->select('id, name, status, description, created_at,')->where('id', $id)->get()->getRow();
		return $builder;
	}
}