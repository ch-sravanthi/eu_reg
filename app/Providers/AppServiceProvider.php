<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
	
	
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		Validator::extend('name', function($attribute, $value, $parameters) {
			// Only Alphabet
			if (!preg_match('/^[A-Za-z. ]+$/', $value)) {
				return false;
			}
			
			$restrict = ['pastor', 'bishop', 'prof', 'brother'];
			$restrictFullMatch = ['rev', 'dr', 'rev.', 'bro', 'pas', 'rt.rev','ps','ps.','rt.rev.', 'mr', 'mrs', 'miss', 'mr.', 'mrs.', 'miss.'];
			$explode = explode(' ', strtolower($value));
			foreach ($explode as $e) {
				// Any where
				foreach ($restrict as $r) {
					if (strpos($e, $r) !== false) {
						return false;
					}
				}
				// Full match
				if (in_array($e, $restrictFullMatch)) {
					return false;
				}
			}
			return true;
        });
		// Custom Validators
		Validator::extend('address_proof_id', function($attribute, $value, $parameters, $validator) {
            $address_proof_type = array_get($validator->getData(), 'address_proof_type');
            if ($address_proof_type == 'aadhar_card') {
                // should not have same charecters
                if (preg_match('/^(.)\1*$/', $value)) {
                    return false;
                }                
                return preg_match("/^[1-9]{1}[0-9]{11}$/", $value);
            } elseif ($address_proof_type == 'pan_card') {
                return preg_match("/^([A-Z]){5}([0-9]){4}([A-Z]){1}$/", $value);
            } elseif ($address_proof_type == 'voter_id') {
                return preg_match("/^([A-Z]){3}([0-9]){7}$/", $value);
            }
            return true;
        });
		Validator::extend('new_address_proof_id', function($attribute, $value, $parameters) {
			
			return (preg_match("/^[1-9]{1}[0-9]{11}$/", $value)) || preg_match("/^([A-Z]){5}([0-9]){4}([A-Z]){1}$/", $value) || preg_match("/^([A-Z]){3}([0-9]){7}$/", $value);
        });
		
		Validator::extend('mobile', function($attribute, $value, $parameters) {
			if(!$value) return true;
			return is_numeric($value) && ($value >= 6000000000 && $value <= 9999999999);
        });
		Validator::extend('pincode', function($attribute, $value, $parameters) {
			return is_numeric($value) && ($value >= 100000 && $value <= 999999);
        });
		Validator::extend('ifsc', function($attribute, $value, $parameters) {
           return preg_match("/^([A-Z]){4}(0){1}([A-Z0-9]){6}$/", $value);            
        });
		Validator::extend('pan', function($attribute, $value, $parameters) {
			 return preg_match("/^([A-Z]){5}([0-9]){4}([A-Z]){1}$/", $value);
        });
		Validator::extend('recaptcha', function($attribute, $value, $parameters) {
			$post = [
            'secret' => '6LfUnFoUAAAAAJcurX937yIDNAxhJrJY9sNoeivp',
            'response' => $value,
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_output = json_decode(curl_exec ($ch), true);
            curl_close ($ch);
            return $server_output['success'] == true;
        });
		Validator::extend('date_multi_format', function($attribute, $value, $formats) {
		  // iterate through all formats
		  foreach($formats as $format) {

			// parse date with current format
			$parsed = date_parse_from_format($format, $value);

			// if value matches given format return true=validation succeeded 
			if ($parsed['error_count'] === 0 && $parsed['warning_count'] === 0) {
			  return true;
			}
		  }

		  // value did not match any of the provided formats, so return false=validation failed
		  return false;
		});
		Validator::extend('time', function($attribute, $value, $parameters) {
			//return is_numeric($value) && ($value >= 6000000000 && $value <= 9999999999);
        });
		
		/*Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
			$sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
		});*/
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('AppHelper', '\App\Helpers\AppHelper');
        $loader->alias('ModelHelper', '\App\Helpers\ModelHelper');
        $loader->alias('FormHelper', '\App\Helpers\FormHelper');
		
    }
}
