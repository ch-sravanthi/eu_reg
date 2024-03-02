<?php

namespace App\Helpers;
use Storage;
use Auth;
use ModelHelper;

class ApiHelper 
{
	
	public static function getModel($name, $field, $value, $excludeId=null, $rel=null) {
		
		$route = 'model/get/'.$name.'/'.$field.'/'.$value.'/'.($excludeId ? $excludeId:'-') .'/'.($rel ? $rel : '-');
		$data = self::get($route);	
		if (empty((array)$data)) {
			return;
		}
		$model = ModelHelper::load($rel ? $rel : $name);
		
		$model->load($data);
		//echo '<pre>'; print_r($model->getAttributes());  echo '</pre>';die();
		return $model;
	}
	
	public static function get($route, $data = null) {
		$user = session('user');
		$orgId = session('organization');
		$authorization = $user && isset($user->token) ? "Authorization: Bearer {$user->token}" : '';
		$org = $orgId ? "Organization: $orgId" : '';
		$ch = curl_init();
		$url = config('app.pb_url').'/api/'.str_replace(' ', '%20', $route);		
		//echo '<pre>'; print_r($url);  echo '</pre>';//die();
		if (!empty($data)) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data' , $authorization, $org));
		} else {
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization, $org));
		}
		if (!$data){
			curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
		}
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$response = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		
		//echo '<pre>'; print_r($response);  echo '</pre>';//die();
		if ($httpcode == 200){
			return json_decode($response);
		} else{
			var_dump($response);die();
			throw new \Exception('Some Error occurred');
		}
	}
	
	public static function fileUrl($name) {		
		return config('app.pb_url').'/'.$name;
	}
	
}
