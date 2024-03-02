<?php
namespace App\Models;

use App\AppModelNew;
use Carbon\Carbon;
use Auth;
use App\Helpers\UserHelper;

class Beneficiary extends AppModelNew
{
	
	/**
     * Relationship Person
     */
    public function person()
    {
        return $this->belongsTo('App\Models\Person');
    }

	/**
	 * Get Old Bankmaster Records
	 */
	public function oldBankmasterRecords($bankmaster = null) {
		$date = (!$bankmaster || !$bankmaster->id) ? Carbon::now() : $bankmaster->created_at;
        return $this->bankmaster_records->where('created_at', '<', $date)->all();
	}

	public function bank_account($bm = false) {
			if ($bm) {
				$bankmaster_record = $this->bankmaster_record();
				if($bankmaster_record && $bankmaster_record->isCompleted()) {
					return $bankmaster_record->bank_account;
				}
			} elseif ($this->project->fcra == 'yes') {
				return $this->project->organization->bank_account();
			} else {
				return $this->person->bank_account();
			}
	}
	
	public function annual_indent_id() {
		$payment = $this->payments()->whereNotNull('annual_indent_id')->first();
		if ($payment) {
			return $payment->annual_indent_id;
		}
	}
	public function annual_indent() {
		$payment = $this->payments()->whereNotNull('annual_indent_id')->first();
		if ($payment) {
			return $payment->annual_indent;
		}
	}
	public function bankmaster() {
		$bankmaster_record = $this->bankmaster_record();
		if ($bankmaster_record) {
			return $bankmaster_record->bankmaster;
		}
	}
	
	public function bankmaster_record() {
		if (!$this->bankmaster_records) {
			return;
		}
		$bankmaster_records = $this->bankmaster_records->whereNotIn('status', ['rejected'])->all();
		foreach ($bankmaster_records as $bankmaster_record) {
			$bank_account = $bankmaster_record->bank_account;
			if ($bank_account->isValid()) {
				return $bankmaster_record;
			} else {
				$bankmaster_record->status = 'rejected';
				$bankmaster_record->remarks = 'Auto rejected as Bank Account is Not Valid';
				$bankmaster_record->save();
			}
		}
	}
	
	public function bankmasterRejected() {
		$bankmaster_record = $this->bankmaster_records()->whereIn('status', ['rejected'])->first();
		return ($bankmaster_record) ? $bankmaster_record->bankmaster : null;
	}
	
	public function canCreateBankmaster() {
		$bank_account = $this->bank_account();
		$bankmaster = $this->bankmaster();
		
		if ($this->project->status == 'approved' && $bank_account && !$bankmaster && !empty($this->code())) {
			return true;
		}		
		return false;
	}
	
	public function notify($subject, $message, $swp = false) {
			$table = [
				'Project Code' => $this->project->code(),
				'Incharge Code' => $this->code(),
				'Incharge' => $this->person->fullname(),
				'Message' => $message,
			];			
			$department = $this->project->department();
			$emails = ["{$department}@sevabharat.org"];
			if ($swp) {
				array_push($emails, 'swp@sevabharat.org');
			}
			array_push($emails, Auth::user()->email);
		
			UserHelper::sendMail($this->route(), $table, $emails, $subject);
	}
	
	public function amount($term) {
		return $this->payments->where('term', $term)->sum('amount');
	}
	
	public function released($term, &$indents) {
		$amount = 0;
		foreach ($this->payments->where('term', $term)->all() as $payment) {
			foreach ($payment->indent_records as $indent_record) {
				if ($indent_record->isValid()) {
					$amount+= $payment->amount;
				}	
				$indents[] = $indent_record;
			}
		}
		return $amount;
	}
}
