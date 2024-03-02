<?php

namespace App\Helpers;
use Storage;
use Auth;
use ModelHelper;

class EncryptHelper 
{

	public static function encryptStr($str) { 
		return self::encrypt($str);
	}

	public static function decryptStr($str) { 
		return self::decrypt($str);
	}

	public static function userDetails($str) { 
		$exp = explode('|', self::decrypt($str));
		if (count($exp) == 4 && is_numeric($exp[0]) && !empty($exp[1]) && !empty($exp[3]))  {
			if (strtotime("now") < $exp[2]) {
				return $exp;
			}
		}
	}

	private static function encrypt($str) {
 
 
		// Store the cipher method
		$ciphering = "AES-128-CTR";
		 
		// Use OpenSSl Encryption method
		$iv_length = openssl_cipher_iv_length($ciphering);
		$options = 0;
		 
		// Non-NULL Initialization Vector for encryption
		$encryption_iv = '8989913236764278';
		 
		// Store the encryption key
		$encryption_key = "UNQ_MES_PWD_KEY";
		 
		// Use openssl_encrypt() function to encrypt the data
		return openssl_encrypt($str, $ciphering,
					$encryption_key, $options, $encryption_iv);
			}
		
		
	private static function decrypt($encryption) {
		 
		// Store the cipher method
		$ciphering = "AES-128-CTR";
		 
		// Use OpenSSl Encryption method
		$iv_length = openssl_cipher_iv_length($ciphering);
				$iv_length = openssl_cipher_iv_length($ciphering);
				$options = 0;
		// Non-NULL Initialization Vector for decryption
		$decryption_iv = '8989913236764278';
		 
		// Store the decryption key
		$decryption_key = "UNQ_MES_PWD_KEY";
		 
		// Use openssl_decrypt() function to decrypt the data
		return openssl_decrypt ($encryption, $ciphering, 
				$decryption_key, $options, $decryption_iv);
			}
}
