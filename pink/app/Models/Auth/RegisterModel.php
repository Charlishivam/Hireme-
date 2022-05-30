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

	public function createUserProfile($profile)
	{
		return $this->db->table('user_profile')->insert($profile);
	}
	
	public function createCompanyProfile($company)
	{   
		return $this->db->table('user_company_profile')->insert($company);
	}

	public function getUserProfileData($email)
	{
		$userData = $this->db->table('user_profile')->select('name, email, mobile, dob, gender, anniversary, address, user_image')
						->where('email', $email)
						->get()->getRow();
		return $userData;
	}

	public function getUserCompanyProfileData($email)
	{
		$companyData = $this->db->table('user_company_profile')->select('user_email, company_name, company_email, company_mobile, company_address, company_logo')->where('user_email', $email)->get()->getRow();
		return $companyData;
		// echo '<pre>';print_r($userData);die;
	}

	public function updateUserData($data, $email) {
		return $this->db->table('user_profile')->where('email', $email)->update($data);
	}

	public function updateCompanyData($data, $email) {
		return $this->db->table('user_company_profile')->where('user_email', $email)->update($data);
	}

	public function updateCompanyLogo($path, $email) {
		return $this->db->table('user_company_profile')->set('company_logo', $path)->where('user_email', $email)->update();
	}

	public function updateUserdp($path, $email) {
		return $this->db->table('user_profile')->set('user_image', $path)->where('email', $email)->update();
	}

	public function createFriend($data)
	{
		return $this->db->table('friend_list')->insert($data);
	}

	public function getData($filter, $start  = '',$export = '', $limit = PAGE_LIMIT) {
		$data = $this->db->table('friend_list')->select('sno, name, image, email, mobile, email, address, dob, anniversary');
		if (!empty($filter['name'])) {
			$data->like('name', $filter['name']);
		}
		if ($export != 'Y') {
			$data->limit($limit, $start);
		}
		$data->orderBy('sno', 'DESC');
		return $data->get()->getResult();
	}

	public function updateFriend($data, $email) {
		// ad($data);
		return $this->db->table('friend_list')->where('email', $email)->update($data);
	}
	
	public function getFriendDob($from, $to) {
		$res =  $this->db->table('friend_list')
						->select('user_email, name, image, address, email, mobile, dob, anniversary')
						->where('dob BETWEEN "'. $from. '" AND "'. $to .'"')
						->orderBy('dob', 'ASC')
						->get()->getResult();
		return $res;
	}

	public function getFriendAnniversary($from, $to) {
		$res =  $this->db->table('friend_list')
						->select('user_email, name, image, address, email, mobile, dob, anniversary')
						->where('anniversary BETWEEN "'. $from. '" AND "'. $to .'"')
						->orderBy('anniversary', 'ASC')
						->get()->getResult();
		return $res;
	}

	public function getCategeory($from, $to) {
		$res =  $this->db->table('categories')
						->select('name, thumbnail, type, eventdate')
						->where('eventdate BETWEEN "'. $from. '" AND "'. $to .'"')
						->orderBy('eventdate', 'ASC')
						->get()->getResult();
		return $res;
	}
}