<?php

namespace App\Models\Secure;

use CodeIgniter\Model;

class TemplateModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'template';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['name', 'slug', 'icon', 'thumbnail', 'status'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	function __construct()
	{
		$this->db = \Config\Database::connect();
	}

	public function getTemplateData($filter = [], $start = '', $export = '', $limit = PAGE_LIMIT)
	{
		$builder = $this->db->table($this->table)->select('id, name, slug, thumbnail, icon, status, created_at, description, price, discount, category_id, startdate, enddate');
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

	public function saveTemplate($data)
	{
		return $this->db->table($this->table)->insert($data);
	}

	public function getTemplate($id)
	{
		$builder = $this->db->table($this->table)->select('id, name, slug, thumbnail, icon, status, created_at, description, price, discount, category_id, startdate, enddate, tag_id')->where('slug', $id)->get()->getRow();
		return $builder;
	}

	public function updateTemplate($id, $data)
	{
		return $this->db->table($this->table)->where('slug', $id)->update($data);
	}

	public function remove($id)
	{
		return $this->db->table($this->table)->where('slug', $id)->delete();
	}

	public function getCategeory()
	{
		return $this->db->table('categories')->select('id, name, slug')->orderBy('name')->get()->getResult();
	}

	public function getTag()
	{
		return $this->db->table('tag')->select('id, name')->orderBy('name')->get()->getResult();
	}
}