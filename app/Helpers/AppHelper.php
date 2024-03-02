<?php

namespace App\Helpers;

use App\Mail\SendMail;
use Storage;
use Auth;
use Mail;

class AppHelper 
{
	public static function otpEmail($email) {
		$code = self::otpCode();
		session(['otp' => $code]);
		self::sendEmail('Dear User, Your OTP for accessing the SEVA- partnersbuddy is '. $code.' .This OTP is valid for 15 mins.',  $email);
		
	}
	public static function otpMobile($mobile, $login=false, $email='') {
		$code = self::otpCode();
		session(['otp' => $code]);
		self::sendSms('Dear User, Your OTP for accessing the SEVA- partnersbuddy is '. $code.' .This OTP is valid for 15 mins.',  $mobile);
		if($login)
		{
			self::sendEmail('Dear User, Your OTP for accessing the SEVA- partnersbuddy is '. $code.' .This OTP is valid for 15 mins.',  $email);
		}
	}
	public static function otpCode() {
		$codeLength = 4;
        $min = pow(10, $codeLength-1);
        $max = $min * 10 - 1;
        
        $code = mt_rand($min, $max);
		return $code;
	}
	public static function  sendEmail($message, $email)
    {
		$subject = 'OTP Code';
		Mail::to($email)->send(new SendMail($subject, $message));
        
    }
	public static function  sendSms($message, $dest_mobileno)
    {
        $sms = urlencode(htmlspecialchars($message));

        $username = "Sblctf"; //use your sms api username
        $pass = "Fasblct"; //enter your password
        $senderid = "SEVABH";//BTOYOU use your sms api sender id
        $priority = "ndnd";//BTOYOU use your sms api sender id
        $stype = "normal";//BTOYOU use your sms api sender id
        $sms_url = "http://bhashsms.com/api/sendmsg.php?user=$username&pass=$pass&sender=$senderid&phone=$dest_mobileno&text=$sms&priority=$priority&stype=$stype";
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$sms_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_TIMEOUT, '3');
        $content = trim(curl_exec($ch));
        curl_close($ch);
    }
	/*
    public static function getDesignations()
    {
        $employee = \Auth::user()->employee;
        $designations = require app_path("Options/designations.php");
        $unset = ['director', 'nm', 'ho', 'it'];
        if ($employee && !empty($employee->zone)) {
            foreach ($unset as $v) {
                unset($designations[$v]);
            }
        }
        return $designations;
    }
    
    public static function getDesignationsToCreate()
    {
        $employee = \Auth::user()->employee;
        $designations = require app_path("Options/designations.php");
        $unset = ['director', 'nm', 'am', 'zoe', 'ho', 'it'];
        if ($employee && !empty($employee->zone)) {
            foreach ($unset as $v) {
                unset($designations[$v]);
            }
        }
        return $designations;
    }
    
    
    public static function getZonesToCreate()
    {
        $zones = require app_path("Options/zones.php");
		$zone = Auth::user()->zone();
        if ($zone) {
            $temp = ['' => ''];
            $temp[$zone] = $zones[$zone];
            $zones = $temp;
        }
        return $zones;
    }
   */
    public static function options($optionname, $values = [])
    {
        return require app_path('Options/'.$optionname.'.php');
    }
    public static function dropdown($value, $optionname)
    {        
        //if(empty($value)) return;
        $options = require app_path('Options/'.$optionname.'.php');
        return isset($options[$value]) ? $options[$value] : '';
    }
   
    public static function dependent($value, $parentvalue, $optionname)
    {
         
        if(empty($value)) return;
        
        $options = require app_path('Options/'.$optionname.'.php');
        return isset($options[$parentvalue][$value]) ? $options[$parentvalue][$value] : '';
    }
	
	public static function toBase64($file) {
		$data = base64_encode($file->get());
		return 'data: '.$file->getMimeType().';base64,'.$data;
	}
	
   
    
	
   public static function autoOptions($option, $key = null)
    {
		$autoOptions = [];
		if (!is_array($option)) {
			$options = require app_path('Options/'.$option.'.php');
		} else{
			$options = $option;
		}
		if($key) $options = $options[$key];
        foreach($options as $k => $v) {
			array_push($autoOptions, ['key' => $k, 'value' => $v]);
		}

		return $autoOptions;
    }
	  /*
    public static function arrayKey($array, $val)
    {
		foreach ($array as $k => $subArray) {
			if (in_array($val, $subArray)) {
				return $k;
			}
		}
    }
	*/
    public static function getZone($state)
    {
        $zones = self::options('zones_states');
		foreach ($zones as $zone => $states) {
			if (isset($states[$state])) {
				return $zone;
			}
		}
    }
	
    public static function getState($district)
    {
        $stateDistricts = self::options('districts');
		foreach ($stateDistricts as $state => $districts) {
			if (isset($districts[$district])) {
				return $state;
			}
		}
    }
	
    public static function getStates($zone)
    {
		return ($zone) ? AppHelper::dropdown($zone, 'zones_states') : AppHelper::options('states');
	}
	
    public static function toArray($value)
    {
        return is_array($value) ? $value : explode(',', $value); 
    }
    /*
    public static function photo($path, $class = 'square-photo')
    {
        if (empty($path)) return;
        $file =  Storage::get($path);
        $base64 = "data:image/jpeg;base64,".base64_encode($file);
        return "<div class='photo $class' style='background-image: url(\"$base64\");'></div>";
    }
    
    
    public static function profilePictureSrc($thumbnail = false)
    {
        
        if (isset(Auth::user()->profile->photo)) {
            $path = Auth::user()->profile->photo;
        } else {
            $path = 'profile/47jG8BIDBZGOGfMgmSTOhs7j2ekbPuJbIrdHfwCZ.png';
        }
        if ($thumbnail) {
                $exp = explode('/', $path);
                $path = $exp[0]."/thumbnails/".$exp[1];
        }
        
        if (empty($path)) return;
        $file =  Storage::get($path);
        return "data:image/jpeg;base64,".base64_encode($file);
    }
    
    public static function profilePicture()
    {
        
        if (isset(Auth::user()->profile->photo)) {
            $path = Auth::user()->profile->photo;
        } else {
            $path = 'profile/47jG8BIDBZGOGfMgmSTOhs7j2ekbPuJbIrdHfwCZ.png';
        }
        
        if (empty($path)) return;
        $file =  Storage::get($path);
        $base64 = "data:image/jpeg;base64,".base64_encode($file);
        return "<div class='photo profile-photo' style='background-image: url(\"$base64\");'></div>";
    }
	
	public static function file_path($path) {
	   return Storage::path($path);
	}
	
	public static function file_content($path) {
	   return Storage::get($path);
	}
   */ 
	public static function datetime($date, $format='d-M-Y h:i A') {
		//var_dump($date);// die();
		$time = new \DateTime($date, new \DateTimeZone('UTC'));
		// than convert it to IST by
		$time->setTimezone(new \DateTimeZone('Asia/Kolkata'));		
		return $time->format($format);
	}
/*
	public static function dates($from, $to) {
		$strFrom = strtotime($from);
		$strTo = strtotime($to);
		if (!$strFrom) {
			return;
		}
		if ($strTo && $strFrom != $strTo) {
			return date('d-M-Y', $strFrom) . ' to ' . date('d-M-Y', $strTo);
		} else {
			return date('d-M-Y', $strFrom);
		}
	}
	
	public static function daysDiff($from, $to) {
		$earlier = new \DateTime($from);
		$later = new \DateTime($to);
		return $later->diff($earlier)->format("%a");
	}
	
	public static function age($date) {
		$str = strtotime($date);
		if ($str) {			
			$birthdate = new \DateTime($date);
			$today   = new \DateTime('today');
			return $birthdate->diff($today)->y;
		}
	}
	
    public static function unsetElements(&$array, $elements)
    {
        foreach ($array as $k => $v) {
            if (in_array($v, $elements)) {
                unset($array[$k]);
            }
        }
    }
	
    public static function requiredLabel($rule)
    {
		if(strpos($rule, 'required_if') !== false) {
			return 'required_if';		
		} elseif(strpos($rule, 'required') !== false) {
			return 'required';		
		} 
    }
    
    public static function numberUS($number){   
		$isNeg = ($number < 0);
		$number = abs($number);
        $decimal = (string)($number - floor($number));
        $money = floor($number);
        $length = strlen($money);
        $delimiter = '';
        $money = strrev($money);
 
        for($i=0;$i<$length;$i++){
            if(( $i==3 || ($i>3 && ($i)%3==0) )&& $i!=$length){
                $delimiter .=',';
            }
            $delimiter .=$money[$i];
        }
 
        $result = strrev($delimiter);
        $decimal = preg_replace("/0\./i", ".", $decimal);
        $decimal = substr($decimal, 0, 3);
 
        if( $decimal != '0'){
            $result = $result.$decimal;
        }
 
        return ($isNeg) ? '-'.$result : $result;
    }
    
    public static function numberIndia($number){   
		$isNeg = ($number < 0);
		$number = abs($number);
        $decimal = (string)($number - floor($number));
        $money = floor($number);
        $length = strlen($money);
        $delimiter = '';
        $money = strrev($money);
 
        for($i=0;$i<$length;$i++){
            if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$length){
                $delimiter .=',';
            }
            $delimiter .=$money[$i];
        }
 
        $result = strrev($delimiter);
        $decimal = preg_replace("/0\./i", ".", $decimal);
        $decimal = substr($decimal, 0, 3);
 
        if( $decimal != '0'){
            $result = $result.$decimal;
        }
 
        return ($isNeg) ? '-'.$result : $result;
    }
    
    public static function financeAbs($number){   
		$num = self::numberIndia(abs($number));
		return ($number < 0) ? "($num)" : $num;
	
	}
	public static function duration ($date) {
		return $date->diffForHumans(now());
	}
		
	
	
	public static function time($v) {
		return date('h:i A', strtotime($v));
	}
	
	public static function createTime($v) {
		return date('H:i', strtotime($v));
	}
	
	public static function optionsYears($type) {
		$options = [];
		for ($y=date('Y'); $y>= 1970; $y--) {
			$options[$y] = $y;
		}
		return $options;
	}
	
	public static function multiexplode ($delimiters,$string) {

		$ready = str_replace($delimiters, $delimiters[0], $string);
		$launch = explode($delimiters[0], $ready);
		return  $launch;
	}
	
	
	public static function code($code) {
		if (!empty($code)) {
			$e = explode('-', $code);
			$code = $e[0].'-'.$e[1].'-'.$e[2];
			return $code;
		}
	}
	
	public static function shortcode($code) {
		$entities = self::options('entities');
		if (!empty($code)) {
			$e = explode('-', $code);			
			$code = $e[1].'-'.$e[2];
			$s = end($e);
			if(!is_numeric($s) && !isset($entities[$s])) {
				return $code.'-'.$s;
			}			
			return $code;
		}
	}
	
	public static function firstcode($code)  {
		if (!empty($code)) {
			$e = explode('-', $code);
			$code = $e[0];
			return $code;
		}
	}
	
	public static function arraySum(&$arr, $keys)  {
		$sum = [];
		foreach ($keys as $k) {
			$sum[$k] = array_sum(array_column($arr, $k));
		}
		return $sum;
	}
	
	
    public static function getFilters($filters, $except)
    {
        //AppHelper
        $return = [];
        foreach ($filters as $k => $v) {
            
            if (in_array($k, $except)){
                continue;
            } elseif (is_array($v) && count($v) == 1 && empty($v[0])) { // array with empty values
                continue;
            } elseif (empty($v)) {
                continue;
            }
            $return[$k] = $v;
        }
        return $return;
    }
	
	public static function getFiscalYear($short = false)
	{
		$y1 = date('Y');		
		$m = date('m');
		if ($m >= 4) {
			$y2 = $y1+1;
		} else {
			$y2 = $y1;
			$y1--;
		}
		
		if (!$short) {
			return $y1 . '-' . substr($y2, -2);
		} else {
			return substr($y1, -2) . '-' . substr($y2, -2);
		}
	}
	
	public static function getFiscalYearFromYear($y) 
	{	
	
		$year = explode('-', $y);
		
		return array(($year[0]).'-04-01', ($year[1]).'-03-31');
	 
	}
	
    public static function location($title, $type, $val)
    {
		$type = ($type) ? $type : '';
        $val = str_replace(['(', ')'], '', $val);		
        return ['title' => $title, 'type' => $type, 'latLng' => explode(',', $val)];
    }
	
	public static function ratio($value, $ratio) {
		 return round( $value/$ratio); 
	}	
	
	public static function percentage($a, $b) {
		 $val = ($b > 0) ? 100 - round( $a*100/$b, 2) : 0; 
		 $decimal = strlen(substr(strrchr($val, "."), 1));
		 return  (strlen($decimal) > 2) ? number_format($val,2) : $val;
	}	
	
	public static function per($a, $b) {
		 $val = ($b > 0) ? round( $a*100/$b, 2) : 0; 
		 $decimal = strlen(substr(strrchr($val, "."), 1));
		 return  (strlen($decimal) > 2) ? number_format($val,2) : $val;
	}	
	
	public static function average($a, $b) {
		  return ($b == 0) ? 0 : round($a/$b);			
	}
	public static function roundToQuarter($number, $denominator = 4) {
		
		$x = $number * $denominator;
		$x = round($x);
		$x = $x / $denominator;
		return $x;
	}

	public static function captalize($str, $toupper = false) {
		$val = ucwords(implode(' ', explode('_', $str)));
		return (!$toupper) ? $val : strtoupper($val);
	}
	
	public static function smallcase($str) {
		$str = substr(preg_replace('/([A-Z])/', '_$1', $str),1);
		return strtolower($str);
	}
	
	public static function limit ($str, $len = 30) {
		$substring = substr($str, 0, $len);
		return  (strlen($str) > $len) ? $substring . '...' : $substring;
	}
	
	public static function round($v, $r) {
		$len = strlen(abs($v - floor($v))) -2;
		return $len > $r ? number_format($v, $r) : $v;
	}*/
	
	
	public static function inputToArray($input, $types, $allowNull = false) {
		
        $firstType = current($types);
        $arr = [];
        foreach ($input[$firstType] as $k => $type) {
                $temp = [];
                $canAdd = true;
                foreach($types as $t) {
                    if(isset($input[$t][$k])) {
                        if (is_null($input[$t][$k])) {
                            $canAdd = false;
                            break;
                        }
                        $temp[$t] = $input[$t][$k];
                    } elseif ($allowNull) {
						$temp[$t] = null;
					}
                }
                if ($canAdd) {
                    $arr[] = $temp;
                }
        }
		
	//	var_dump($allowNull);die();
        return $arr;
    }
	/*
	public static function issetValue(&$arr, $v) {
		return isset($arr[$v]) ? $arr[$v] : null;
	}
	
	public static function existsInArray($a, $b) {
		$new = [];
		foreach ($a as $k) {
			if (!in_array($k, $b)) {
				$new[] = $k;
			}
		}
		return $new;
	}
	
	public static function containsInArray($a, $b) {
		foreach ($a as $k) {
			if (in_array($k, $b)) {
				return true;
			}
		}
		return false;
	}
	
	public static function getStartAndEndDate($week, $year) {
	  $dto = new \DateTime();
	  $dto->setISODate($year, $week);
	  $ret[0] = $dto->format('d-M-y');
	  $dto->modify('+6 days');
	  $ret[1] = $dto->format('d-M-y');
	  return $ret[0] . ' to ' . $ret[1];
	}*/
	
	public static function excerpt($str, $max=20, $more = false) {
		if (strlen($str) <= $max) {
			return $str;
		} elseif(!$more) {
			return substr($str,0,$max)."...";
		} else {
			return substr($str,0,$max)."<span><span class='pointer' onclick='$(this).addClass(\"d-none\");$(this).next(\"span\").removeClass(\"d-none\")'>...View More</span><span class='d-none'>".substr($str,$max).'</span></span>';
		}
	}
	 public static function multiple($value, $optionname, $parentvalue='', $divider = ', ')
    {

        if(empty($value) || !file_exists(app_path('Options/'.$optionname.'.php'))) return;

        $options = is_array($optionname) ? $optionname : require app_path('Options/'.$optionname.'.php');
        $returnValue = '';
		// if array take directly, if not explode
        $value = (is_array($value)) ? $value : explode(',', $value) ;
        foreach ($value as $v) {
            if (empty($parentvalue) && isset($options[$v])) $returnValue.= $options[$v].$divider;
            elseif (!empty($parentvalue) && isset($options[$parentvalue][$v])) $returnValue.= $options[$parentvalue][$v].$divider;
        }
        return rtrim($returnValue, $divider);
    }
	public static function date($v) {
		if (strtotime($v)) {
			return date('d-M-y', strtotime($v));
		}
	}
}
