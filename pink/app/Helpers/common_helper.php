<?php

function filter_inp($value) {
	return strip_tags(trim($value));
}

function show_404() {
	throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
}

function show_method_notfound($method) {
	throw \CodeIgniter\Exceptions\PageNotFoundException::forMethodNotFound($method);
}

function gen_ref_id() {
	return date('Ymd'). time() . mt_rand(100, 999);
}

function gen_ts() {
	return date('Y-m-d\TH:i:s.B');
}

function get_agent() {
	$request = service('request');
	$agent = $request->getUserAgent();
	return $agent->getBrowser() . ' ' . $agent->getVersion();
}

function get_ip() {
	$request = service('request');
	return $request->getIPAddress();
}

function lq($def_db = '') {
	$db = \Config\Database::connect();
	if (!empty($def_db)) {
		$db = \Config\Database::connect($def_db);
	}
	$query = $db->getLastQuery();
	echo (string) $query;
	die;
}

function flash_msg($response = '', $msg = '') {
	$session = \Config\Services::session();
	$session->setFlashdata('response', $response ?? 'error');
	$session->setFlashdata('message', $msg ?? 'Something went wrong');
}

function date_format_Bytype($date = '0000-00-00', $type = 'ymd') {
	if ($date == '') {
		return '0000-00-00';
	}
	if ($type == 'ymd') {
		return date('Y-m-d', strtotime($date));
	} elseif ($type == 'dmy') {
		return date('d-m-Y', strtotime($date));
	}
}

function formated_date($str) {
	if (!empty($str)) {
		return date('d-M-Y', strtotime($str));
	}
	return date('d-M-Y');
}

function first_char($str)
{
	return strtoupper(substr($str,0,1));
}

function asset($path){
	return base_url('assets/'.$path);
}

function formatted_datetime($str) {
	if (!empty($str)) {
		return date('d-M-Y  h:i A', strtotime($str));
	}
	return date('d-M-Y');
}

function ad($arr){
	echo('<pre>');
	print_r($arr);
	die;
}

function pd($arr){
	echo('<pre>');
	print_r($arr);
}

function vd($arr){
	echo('<pre>');
	var_dump($arr);
	die;
}

function short_name($value = '') {
	if (empty($value)) {
		return $value;
	}
	$array = explode('@', $value);
	$is_email = FALSE;
	if (count($array) == 2) {
		$is_email = TRUE;
	}
	$first = substr($array[0], 0, 2) . '-xxx-xxx-' . substr($array[0], -2);
	return ($first . ($is_email ? '@' . $array[1] : ''));
}

function get_referer(){
	return $_SERVER['HTTP_REFERER'] ?? '';
}

function array_to_str($m, $delim = '|', $seperator = '=') {
	$arr = (array) $m;
	$ret = "";
	foreach ($arr as $k => $v) {
		$ret .= trim($k) . $seperator . trim($v) . $delim;
	}
	return $ret;
} // function end array_to_str

function str_to_array($str, $delim = '|', $seperator = '=') {
	if (!$str) {
		return false;
	}

	$vals = explode($delim, $str);

	if (!$vals && count($vals) <= 0) {
		return false;
	}

	$ret = array();
	foreach ($vals as $req) {
		$eq_pos = strpos($req, $seperator);
		if ($eq_pos >= 0) {
			$k = trim(substr($req, 0, $eq_pos));
			$v = trim(substr($req, $eq_pos + strlen($seperator)));
			if ($k) {
				$ret[$k] = $v;
			}
		} //End if($eq_pos >= 0 )
	} //End foreach ..
	return $ret;
} // End private function _string_to_array

function client_ip()
{
	if (!empty($_SERVER['HTTP_CLIENT_IP']))   
	{
		return $_SERVER['HTTP_CLIENT_IP'];
	}
	//whether ip is from proxy
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
	{
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	//whether ip is from remote address
	else
	{
		return $_SERVER['REMOTE_ADDR'];
	}
}

function aesencrypt($plain, $key, $in = "A", $enc_out = "HEX")
{
    if ($in == 'A') {
        $plain = array_to_str($plain);
    }
    $method   = 'AES-256-CBC';
    $aes_key  = base64_decode($key);
    $iv       = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));
    $enc_int  = aes_encrypt($plain, $method, $aes_key, $iv); // encrypt random
    $enc_data = $iv . $enc_int; // pad data and iv bytes
    if ($enc_out == 'HEX') //Hex
        {
        $enc_dat = bin2hex($enc_data);
    }
    if ($enc_out == 'B64') {
        $enc_dat = base64_encode($enc_data);
    }
    return $enc_dat;
}

function aesdecrypt($enc_dat, $key, $ret, $enc_out = 'HEX')
{
    if ($enc_out == 'HEX') //Hex
        {
        $cipher = hex2bin($enc_dat);
    }
    if ($enc_out == 'B64') {
        $cipher = base64_decode($enc_dat);
    }
    $enc      = stat_split($cipher); // decode cipher
    $aes_key  = base64_decode($key);
    $method   = 'AES-256-CBC';
    $dec_data = aes_decrypt($enc['dat'], $method, $aes_key, $enc['iv']); // decrypt dynamic
    if ($ret == 'A') {
        return str_to_array($dec_data, "|");
    } else {
        return $dec_data;
    }
}

// get iv values
function stat_split($enc)
{
    $d['iv']  = substr($enc, 0, 16);
    $d['dat'] = substr($enc, 16);
    return $d;
}

// aes encrypt core
function aes_encrypt($plain_text, $method, $aes_key, $iv)
{
    $enc = openssl_encrypt($plain_text, $method, $aes_key, OPENSSL_RAW_DATA, $iv);
    return $enc;
}

// aes decrypt core
function aes_decrypt($cipher_text, $method, $aes_key, $iv)
{
    $dec = openssl_decrypt($cipher_text, $method, $aes_key, OPENSSL_RAW_DATA, $iv);
    return $dec;
}

function get_id_type($str)
{
	if (intval($str) && strlen($str) == 10) {
		return 'M';
	}
	elseif (filter_var($str, FILTER_VALIDATE_EMAIL)) {
		return 'E';
	}else{
		return 'U';
	}
}

function verify_time($time, $maxtime)
{
	$diff_time = abs(time() - $time);
	if($diff_time < $maxtime){
		return TRUE;
	}
	return FALSE;
}

function get_gender($gender) {
	switch ($gender) {
	case "M":
		return 'Male';
	case "F":
		return 'Female';
	case "T":
		return 'Transgender';
	}
	return "Other";
}

function auth_logo()
{
	return '<img src="'.asset("frontend/img/logo.png").'" class="mb-4" style="height: 40px; width: auto;" />';
}

function auth_background()
{
	return '<img src="'.asset("frontend/img/information-img.png").'" class="login-img" />';
}

function decrypt_data($ciphertext, $cookie = 'auth_cook')
{
	$salt = get_cookie($cookie, TRUE);
	if (empty($salt)) {
		return FALSE;
	}
	$priv_key = RSA_PRIVATE_KEY;
	$res = openssl_get_privatekey(base64_decode($priv_key));
	openssl_private_decrypt(base64_decode($ciphertext), $passtext, $res);
	$text = base64_decode($passtext);
	$data = explode(':', $text);
	if (count($data) != 2) {
		delete_cookie($cookie);
		return FALSE;
	}
	if ($data[1] != $salt) {
		delete_cookie($cookie);
		return FALSE;
	}
	delete_cookie($cookie);
	return $data[0];
}

function decrypt_data_new($ciphertext)
{
	$priv_key = RSA_PRIVATE_KEY;
	$res = openssl_get_privatekey(base64_decode($priv_key));
	openssl_private_decrypt(base64_decode($ciphertext), $passtext, $res);
	$text = base64_decode($passtext);
	return $text;
}

function checkPass($pass1, $pass2)
{
	return hash('sha256', $pass1) === $pass2;
}

function accountStatus($status)
{
	switch ($status) {
		case 'DISABLE':
			return 'Your account has been deactivated';
			break;
		case 'SUSPEND':
			return 'Your account has been suspended';
			break;
		
		default:
			return 'Your account has been deactivated';
			break;
	}
}

function admin()
{
	$session = \Config\Services::session();
	return $session->get('admin');
}

function user()
{
	$session = \Config\Services::session();
	return $session->get('user');
}

function base64_to_jpeg($base64, $folder = 'uploads') {
	$f = finfo_open();
	$imgdata = base64_decode($base64);
	$mime_type = finfo_buffer($f, $imgdata, FILEINFO_MIME_TYPE);
    if (!in_array(strtolower($mime_type), ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'])) {
    	return false;
    }
    $file 	= date('ymdhis').'.jpg';
    $main_dir 	= WRITEPATH  . "$folder/";
    if (!file_exists($main_dir)) {
		mkdir($main_dir, 0777, true);
	}
	file_put_contents("$main_dir$file", $imgdata);
	return ['path' => $folder . '/' . $file, 'status' => true];
}

function remove_file($file)
{
	@unlink(WRITEPATH.$file);
}

function languages()
{
	$data = [
		'English', 'Hindi', 'Spanish', 'Chinese', 'Arabic', 'Portuguese', 'Bengali', 'Russian', 'Japanese', 'Punjabi', 'Urdu'
	];
	sort($data);
	return $data;
}

function level()
{
	$data = [
		'Beginer', 'Intermediate', 'Expert'
	];
	sort($data);
	return $data;
}

function file_path($path)
{
	return base_url('FileReader/filew?path='.bin2hex($path));
}

function video_path($path)
{
	return base_url('FileReader/filev?path='.bin2hex($path));
}

function convert_json($seperator, $string)
{
	return json_encode(explode($seperator, $string));
}

function default_user_thumbnail()
{
	return base_url('assets/backend/img/user.jpg');
}

function default_cat_img($thumbnail = '')
{
	return empty($thumbnail) ? asset('frontend/img/course/cat_01.jpg') : file_path($thumbnail);
}

function default_thumbnail()
{
	return base_url('assets/backend/img/default.jpg');
}

function profile_status($status)
{
	switch ($status) {
		case '1':
			return '<span class="label-light-danger">Incomplete</span>';
			break;

		case '2':
			return '<span class="label-light-warning">Partial Complete</span>';
			break;

		case '3':
			return '<span class="label-light-success">Complete</span>';
			break;
		
		default:
			return '<span class="label-light-danger">Incomplete</span>';
			break;
	}
}

function saveCache($key, $data, $time = CACHE_SESSION_TIME)
{
	$cache 	= \Config\Services::cache();
	$cache->save($key, json_encode($data), $time);
}

function getCache($key)
{
	$cache 	= \Config\Services::cache();
	return json_decode($cache->get($key));
}