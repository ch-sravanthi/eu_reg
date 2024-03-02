<?php
namespace App\Policies;
use App\User;
use App\Models\ProjectBill;

class ProjectBillPolicy
{
  
   public function create(User $user)
  { 	
		return $user->hasAnyRole(['sc', 'dc', 'zoe']);
		
  }
  
   public function edit(User $user, ProjectBill $project_bill)
  { 	
		return (($user->id == $project_bill->created_by) && in_array($project_bill->status, ['created', 'need_clarifications'])) 
				|| ($user->hasAnyRole(['accountant']) && in_array($project_bill->status, ['created', 'need_clarifications', 'assigned']))
				|| $user->isAdmin() || $user->hasAnyRole(['ad_finance']);
		
  }  
   
  
 
}
