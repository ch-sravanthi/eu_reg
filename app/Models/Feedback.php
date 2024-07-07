<?php
namespace App\Models;

use App\AppModel;
use App\Helpers\AppHelper;

class Feedback extends AppModel
{
	protected $table = 'feedbacks';
   
	protected $fillable=[
	  'rate',
	  'article',
	  'topics_themes',
	  'experience',
	  'comments',
	  
	];
	
	public $nicenames =  [
			 'rate' => 'Name',
			  'article' => 'Article',
			  'topics_themes' => 'Theme',
			  'experience' => 'Experience',
			  'comments' => 'Comments',
			  
	];
		
	public function niceNames()
	{
		return[
			  'rate' => 'Name',
			  'article' => 'Article',
			  'topics_themes' => 'Theme',
			  'experience' => 'Experience',
			  'comments' => 'Comments',
		];
	}
	
	public function rules(){
		return[
			  'rate' =>	'required',
			  'article' => 'required',
			  'topics_themes' => 'required',
			  'experience' =>  'required',
			  'comments' => 'required',
		];
	}
}
