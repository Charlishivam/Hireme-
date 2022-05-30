<?php

namespace App\Models\Frontend;

use CodeIgniter\Model;

class FrontendModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'template';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['name', 'slug', 'icon', 'thumbnail', 'status', 'description', 'price', 'discount', 'category_id', 'startdate', 'enddate'];

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

	public function getTemplateData($filter = [], $start = '', $limit = PAGE_LIMIT_TEMP)
	{
		// echo '<pre>';print_r($filter['slug']);die;
		$builder = $this->db->table($this->table)->select('id, name, slug, thumbnail, icon, status, created_at, description, price, discount, category_id, startdate, enddate, tag_id, featured, bestceller');
		if (!empty($filter['slug'])) {
			$builder->whereIn('category_id', $filter['slug']);
			$builder->where('status', 'ENABLE');
		}
		if (!empty($filter['tag'])) {
			$builder->orWhereIn('tag_id', $filter['tag']);
			$builder->where('status', 'ENABLE');
		}
		// $builder->where('status', 'ENABLE');
		$builder->limit($limit, $start);
		$builder->orderBy('id', 'DESC');
		// $builder->get()->getResult();
		// echo '<pre>';print_r($this->db->getLastQuery());die;
		return $builder->get()->getResult();
	}

	public function getTemplateDetail($id)
	{
		$builder = $this->db->table($this->table)->select('id, name, slug, thumbnail, icon, status, created_at, description, price, discount, category_id, startdate, enddate tag_id, featured, bestceller');
		$builder->where('slug',$id);
		return $builder->get()->getRow();
	}

	public function getCategeoryList()
	{
		return $this->db->table('categories')->select('id, name, slug')->where('status', 'ENABLE')->orderBy('name')->get()->getResult();
	}

	public function getTagList()
	{
		return $this->db->table('tag')->select('id, name')->where('status', 'ENABLE')->orderBy('name')->get()->getResult();
	}

	public function getCelibrationList(){
		return $this->db->table('categories')->select('id, name, slug')->where('type', 'CELEBRATION')->where('status', 'ENABLE')->orderBy('name')->get()->getResult();

	}

	public function getFestivalList(){
		return $this->db->table('categories')->select('id, name, slug')->where('type', 'FESTIVAL')->where('status', 'ENABLE')->orderBy('name')->get()->getResult();

	}

	public function dashboardCategeory(){
		$res =  $this->db->table('categories')->select('id, name, slug, thumbnail, icon, status, created_at, description, startdate, enddate')->where('status', 'ENABLE')->orderBy('name')->limit('3')->get()->getResult();
		$result = $res;
		$temp = [];
		foreach ($res as $key => $cel) {
			$count = $this->db->table('template')->select('*')->where('category_id',$cel->id)->countAllResults();
			$cel->icon = $count;
		}
		return $result;
	}

	public function addNewaTemplate($data){
		$resp =  $this->db->table('template_data')->insert($data);
		if ($resp) {
			return true;
		}
		
	}

	public function getCompanyProfile($email){
	    return  $this->db->table('user_company_profile')->select('company_logo')->where('user_email', $email)->get()->getRow();
	    //ad($a);
	}
}