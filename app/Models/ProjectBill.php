<?php

namespace App\Models;

use App\AppModel;
//use Auth;
use App\Helpers\AppHelper;
use Illuminate\Notifications\Notifiable;

class ProjectBill extends AppModel
{
	 use Notifiable;
	//abstract public function settlement_records();
	
    protected $fillable = [
        'project_code',
        'amount',
		'comments',
		'bill_attachment_1',
		'bill_attachment_2',
		'bill_attachment_3',
		'term',
		'category',
		'full_name',
		'phone',
		'email',
    ];

	public function rules()
	{
        return[	
			'term' => 'required',
			'amount' => 'required',
			'bill_attachment_1' => 'required|mimes:jpeg,jpg,png|max:2000',
        ];
	}
	
	
	public function partner_rules()
	{
        return[	
			'amount' => 'required',
			'bill_attachment_1' => 'required|mimes:jpeg,jpg,png|max:2000',
			'term' => 'required',
        ];
	}
	
	public function niceNames()
	{   
        return [		
				'project_code'=>'Project Code',
				'amount' => 'Bill Amount',
				'comments' => 'Remarks',
				'category' => 'Category',
				'bill_attachment_1' => 'Bill Attachment 1',
				'bill_attachment_2'  => 'Bill Attachment 2',
				'bill_attachment_3'  => 'Bill Attachment 3',
				'reject_comments'  => 'Reject Comments',
			];
	}

	
	
}

?>

