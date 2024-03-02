<?php
namespace App\Models;
use App\AppModelNew;

class CdpTtpReport extends AppModelNew
{
    protected $table = 'ttp_reports'; 
	
    protected $fillable = [
		'ttp_support',
		'no_of_programs',
		'ttp_conducted_from_date',
		'ttp_conducted_to_date',
		'ttp_conducted_place',
		'ttp_attended_teachers_no',
		'coordinator_staff_attended',
		
		'classes_conducted_from_date',
		'tenday_conducted_teachers_no',
		'tenday_volunteers_trained_no',
		'tenday_incharge_coordinator',
		'total_christian_no',
		'total_non_christian_no',
		'children_decision_made_no',
		'children_new_life_members_no',
		'parents_attended_no',
		'parents_decisions_no',
		'parents_new_life_no', 
		'tenday_people_group_reached',
		'tenday_villages_reached',
		'followup_book',
		'followup_books_received_no',
		'trees_planted_no',
		'harvest_pit_digged_no',
		'suggestions',
		'places_conducted',
		'groups_reached',
	];
	
	
	public function rules()
	{
        return[
		//'ttp_support' => 'required',
		//'no_of_programs' => 'required',
		'ttp_conducted_from_date' => 'date_multi_format:"Y-n-j", "Y-m-d"|required|date',
		'ttp_conducted_to_date' => 'date_multi_format:"Y-n-j", "Y-m-d"|required|date|after_or_equal:ttp_conducted_from_date',
		'ttp_conducted_place' => 'required',
		'ttp_attended_teachers_no' => 'required|numeric',
		'coordinator_staff_attended' => 'required',
		
		
		'classes_conducted_from_date' => 'required|date|after:ttp_conducted_from_date',
		'tenday_conducted_teachers_no' => 'required|numeric',
		'tenday_volunteers_trained_no' => 'required|numeric',
		'total_christian_no' => 'required|numeric',
		'total_non_christian_no' => 'required|numeric',
		//'total' => 'numeric',
		'children_decision_made_no' => 'required|numeric',
		'children_new_life_members_no' => 'required|numeric',
		'parents_attended_no' => 'required|numeric',
		'parents_decisions_no' => 'required|numeric',
		'parents_new_life_no' => 'required|numeric',
		'tenday_people_group_reached' => 'required',
		'tenday_villages_reached' => 'required',
		'trees_planted_no' => 'required|numeric',
		'harvest_pit_digged_no' => 'required|numeric',
		'suggestions' => 'required',
	    ];
	}
	
	public function getRules(){
		return $this->rules;
	}
	
	public function getFillable(){
		return $this->fillable;
	}
	
	public function niceNames()
    {
        return [
		'ttp_support' => 'TTP Supported by Seva Bharat',
		'no_of_programs' => 'Report for No. of TTPs',
		'cbc_info' => 'CBC 10 Day Report',	
		'ttp_info' => 'TEN DAY REPORTS',
		'ttp_conducted_from_date' => ' From Date',
		'ttp_conducted_to_date' => 'To Date',
		'ttp_conducted_place' => 'Conducted at (Place Name)',
		'ttp_attended_teachers_no' => 'No.of Teachers Attended the Training',
		'partner_new_or_old' => 'Is Partner(New/Old)',
		'coordinator_staff_attended' => 'Co-ordinator Staff Attended',
		
		
		
		'reached' => 'Total Children Reached',	
		'ttp_attended_teachers_no' => 'No.of Teachers Attended the Training',
	//	'total_teachers_trained' => 'Total Teachers Trained',
		'average_teachers_trained_ratio' => 'Average Vol. Trained ratio',
		'no_of_programs' => 'Total TTPs',
		'self_supported' => 'Self Supported',
		'sb_supported' => 'SB Supported',
		'partners' => 'Partners',
		'children_commitment' => 'Children Commitment(%) w.r.t Children Reached',
		'children_new_life' => 'Children New Life(%) w.r.t Commitments',
		'average_attendance_per_ttp' => 'Children Average Attendance (per TTP)',
		'coordinator_staff_attended' => 'Co-ordinator Staff Attended',
		'classes_conducted_from_date' => '10 Day Classes Conducted From Date',
		'classes_conducted_to_date' => '10 Day Classes Conducted To Date',
		'tenday_conducted_teachers_no' => 'No.of Teachers Conducted 10 Day Classes',
		'tenday_volunteers_trained_no' => 'No.of Volunteers Trained or Involved During 10 Day Classes',
		'tenday_incharge_coordinator' => 'In-Charge Field Coordinator for 10 Day Classes',
		'total_christian_no' => 'Total Christian Children',
		'total_non_christian_no' => 'Total Non-Christians Childern',
		'total'	=>	'Total',
		'children_decision_made_no' => 'No.of Children made decisions',
		'children_new_life_members_no' => 'No.of Children became New Life Members',
		'parents_attended_no' => 'No.of Parents Attended or Observed During 10 Day Classes',
		'parents_decisions_no' => 'No.of Parents Made Decisions',
		'parents_new_life_no' => 'No.of Parents Became New Life Members',
		'tenday_people_group_reached' => 'Name of the People Group/Communities Children Reached',
		'tenday_villages_reached' => 'Name of the Villages Reached During 10 Day Classes',
		'followup_book' => 'Follow-up Books',
		'followup_books_received_no' => 'How Many Follow-up Books Received',
		'trees_planted_no' => 'No.of Saplings Planted',
		'harvest_pit_digged_no' => 'No.of Water Harvest Pit Digged',
		'suggestions' => 'Any Suggestions/Comments',
		'created_by' => 'Created',
		'tenday_classes_info' => '10 Day Classes Information',
		'tenday_classes_results_report' => 'Ten Day Classes Results (Report after 10day Classes)',
		'people_groups_communities' => 'People Group/Communities',
		'followup_books' => 'Follow-up Books',
		'go_green_info' => 'Go Green & Water Harvest Pit Information',
		'places_conducted' => 'No of Places Conducted',
		'groups_reached' => 'No of people groups Reached',
		'location_label' => 'Location'
		];
    }
    public function project()
    {
        return $this->belongsTo('App\Models\CdpTtpProject');
    }
	
	protected static function boot()
    {
		parent::boot();
       
		static::saving(function ($model) {
			
			$str = strtotime($model->classes_conducted_from_date);
			$model->classes_conducted_to_date = date('Y-m-d', strtotime("+9 days", $str)); 
        });
    }
	
	
	
	public function reportFields(){
		 return [
				'tenday_conducted_teachers_no',
				'tenday_volunteers_trained_no',
				'total_christian_no',
				'total_non_christian_no',
				'children_decision_made_no',
				'children_new_life_members_no',
				'parents_attended_no',
				'parents_decisions_no',
				'parents_new_life_no',
				'followup_books_received_no',
				'trees_planted_no',
				'harvest_pit_digged_no',
		];		
	}
	
	public function consolidatedReportFields(){
		 return [
				'reached',
				'ttp_attended_teachers_no',
			//	'total_teachers_trained',
				'tenday_conducted_teachers_no',
				'tenday_volunteers_trained_no',
				'average_teachers_trained_ratio',
				'no_of_programs',
				'self_supported',
				'sb_supported',
				'partners',
				'total_christian_no',
				'total_non_christian_no',
				'children_decision_made_no',
				'children_commitment',
				'children_new_life_members_no',
				'children_new_life',
				'average_attendance_per_ttp',
				'parents_attended_no',
				'parents_decisions_no',
				'parents_new_life_no',
				'followup_books_received_no',
				'trees_planted_no',
				'harvest_pit_digged_no',
		];		
	}
	
	public function getReachedAttribute(){
		return  $this->total_christian_no + $this->total_non_christian_no;		
	}
	
	/*public function getTtpAttendedTeachersNoAttribute(){		
		return  $this->project->ttp_attended_teachers_no;		
	}*/
	
	/*public function getTotalTeachersTrainedAttribute(){		
		return  $this->tenday_conducted_teachers_no + $this->tenday_volunteers_trained_no;		
	}*/
	
	
	public function ratio($a,$b) {
	  $l = min($a,$b);
	  if($a !=0 || $b !=0){
		return round($a/$l).':'.round($b/$l);
	  }
	}
	public function indexRoute() {
		return route('cdp_ttp_reports');
	}
}
