<?php
class Pushnotifications 
{
    
    //reminder traget step notification
	private static $url = 'https://fcm.googleapis.com/fcm/send';

	public static function android($apiKey,$data) 
	{
		
		$message = array(
			'title'        => $data['title'],
			'body'         => $data['body'],
			'id'           => $data['id'],
			'type'         => $data['type'],
			'click_action' => isset($data['click_action']) ? $data['click_action'] : '',
			'msgcnt' => 1,
			'vibrate' => 1
		);
		$headers = array(
			'Authorization: key=' .$apiKey,
			'Content-Type: application/json'
		);
		
		if(is_array($data['device_token']))
			$device_token = $data['device_token'];
		else
			$device_token = array($data['device_token']);
		$fields = array(
			'registration_ids' => $device_token,
			'data' => $message,
		);
		//echo "<pre>";print_r($fields);die;
		return self::useCurl(self::$url, $headers, json_encode($fields));

	}
	
	public static function iOS($apiKey,$data) 
	{
        $message = array(
			'title'        => $data['title'],
			'body'         => $data['body'],
			'id'           => $data['id'],
			'type'         => $data['type'],
			'click_action' => isset($data['click_action']) ? $data['click_action'] : '',
			'msgcnt' => 1,
			'vibrate' => 1
		);
		$headers = array(
			'Authorization: key=' .$apiKey,
			'Content-Type: application/json'
		);
		
		if(is_array($data['device_token']))
			$device_token = $data['device_token'];
		else
			$device_token = array($data['device_token']);
		$fields = array(
			'registration_ids' => $device_token,
			'data' => $message,
		);
		//echo "<pre>";print_r($fields);die;
		return self::useCurl(self::$url, $headers, json_encode($fields));
    }
	
	private static function useCurl($url, $headers, $fields = null) 
	{
		$ch = curl_init();
		if ($url) 
		{
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
			if ($fields) 
			{
				curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
			}
			$result = curl_exec($ch);
			if ($result === FALSE) 
			{
				die('Curl failed: ' . curl_error($ch));
			}
		    echo "<pre>";print_r($result);die;echo "</pre>"; 
			curl_close($ch);

			return $result;
		}
    }


   
}