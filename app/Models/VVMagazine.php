<?php
namespace App\Models;

use App\AppModel;
use App\Helpers\AppHelper;

class VVMagazine extends AppModel
{
    protected $table = "vv_magazines";
	
	protected $fillable=[
		'name_of_the_file',
		'cover_page',
		'prayer_copy',
		'magazine_copy',
		'magazine_month',
		'magazine_year',
	];
	
	
	public function rules()
	{
		return[
			'name_of_the_file' => 'nullable',
			'cover_page' => 'nullable|mimes:jpeg,jpg,png|max:1024',
			'prayer_copy'	=>	'required|mimes:pdf|max:1024',
			'magazine_copy'	=>	'required|mimes:pdf|max:5120',
			'magazine_month' =>	'required',
			'magazine_year' => 'required',
		];
	}
	
	public $nicenames =  [
			'name_of_the_file' => 'Title of the Cover Page',
			'cover_page' => 'Cover Page Image',
			'prayer_copy' => 'Prayer Points Copy',
			'magazine_copy' => 'Magazine Edition',
			'magazine_month' => 'Month',
			'magazine_year' => 'Year',
	];
	public function niceNames()
	{
		return[
			'name_of_the_file' => 'Title of the Magazine',
			'cover_page' => 'Cover Page Image',
			'prayer_copy' => 'Prayer Points Copy',
			'magazine_copy' => 'Magazine Edition',
			'magazine_month' => 'Month',
			'magazine_year' => 'Year',
		];
	}
	
}
