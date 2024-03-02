<?php

namespace App\Providers;

//use Laravel\Passport\Passport; 
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',       
        'App\User' => 'App\Policies\UserPolicy',
        'App\Models\AlActualReport' => 'App\Policies\AlActualReportPolicy',
        'App\Models\BankAccount' => 'App\Policies\BankAccountPolicy',
        'App\Models\ProgramRequest' => 'App\Policies\ProgramRequestPolicy',
        'App\Models\Program\Program' => 'App\Policies\ProgramPolicy',
        'App\Models\Program\NewProgram' => 'App\Policies\NewProgramPolicy',
        'App\Models\Project' => 'App\Policies\ProjectPolicy',
        'App\Models\Organization' => 'App\Policies\OrganizationPolicy',
        'App\Models\Employee\Employee' => 'App\Policies\EmployeePolicy',
        'App\Models\Employee\Leaves\EmployeeLeave' => 'App\Policies\EmployeeLeavePolicy',
        'App\Models\Employee\Travel\EmployeeExpenseClaim' => 'App\Policies\EmployeeExpenseClaimPolicy',
        'App\Models\Employee\HodFeedback' => 'App\Policies\HodFeedbackPolicy',
        'App\Models\Employee\Travel\EmployeePlan' => 'App\Policies\EmployeePlanPolicy',
        'App\Models\Person' => 'App\Policies\PersonPolicy',
        'App\Models\ProjectApproval' => 'App\Policies\ProjectApprovalPolicy',
        'App\Models\Indent\Project\ProjectIndent' => 'App\Policies\ProjectIndentPolicy',
        'App\Models\ProjectIncharge' => 'App\Policies\ProjectInchargePolicy',
        'App\Models\CenterIncharge' => 'App\Policies\CenterInchargePolicy',
        'App\Models\Ict\IctTutor' => 'App\Policies\IctTutorPolicy',
        'App\Models\Bankmaster\Bankmaster' => 'App\Policies\BankmasterPolicy',
        'App\Models\Payment\Payment' => 'App\Policies\PaymentIndentPolicy',
        'App\Models\Promotion\PromotionSubmission' => 'App\Policies\PromotionIndentPolicy',
        'App\Models\PromotionMagazineSubmission' => 'App\Policies\PromotionMagazineIndentPolicy',
        'App\Models\Promotion\PromotionReceipt' => 'App\Policies\PromotionReceiptPolicy',
        'App\Models\PromotionMagazineReceipt' => 'App\Policies\PromotionMagazineReceiptPolicy',
        'App\Models\Promotion\PromotionDonor' => 'App\Policies\PromotionDonorPolicy',
        'App\Models\CdpTheme' => 'App\Policies\CdpThemePolicy',
        'App\Models\CdpPrintRequirement' => 'App\Policies\CdpPrintRequirementPolicy',
		'App\Models\CdpPrintRequest' => 'App\Policies\CdpPrintRequestPolicy',
        'App\Models\Llt\LltProject' => 'App\Policies\LltProjectPolicy',
		'App\Models\Visit\ProjectVisit' => 'App\Policies\ProjectVisitPolicy',
		'App\Models\IaVisit' => 'App\Policies\IaVisitPolicy',
		'App\Models\IctCdpPrintRequest' => 'App\Policies\IctCdpPrintRequestPolicy',
        'App\Models\IctCdpPrintRequirement' => 'App\Policies\IctCdpPrintRequirementPolicy',
        'App\Models\IctPrintRequestRecord' => 'App\Policies\IctPrintRequestRecordPolicy',
        'App\Models\IctDispatchRecord' => 'App\Policies\IctDispatchRecordPolicy',
        'App\Models\IctDispatchItem' => 'App\Policies\IctDispatchItemPolicy',
        'App\Models\IctDispatch' => 'App\Policies\IctDispatchPolicy',
        'App\Models\AscReport' => 'App\Policies\AscReportPolicy',
        'App\Models\AlReport' => 'App\Policies\AlReportPolicy',
        'App\Models\IctReport' => 'App\Policies\IctReportPolicy',
        'App\Models\IctProjectReport' => 'App\Policies\IctProjectReportPolicy',
		'App\Models\AlPrintRequirement' => 'App\Policies\AlPrintRequirementPolicy','App\Models\DpVolunteerPayment' => 'App\Policies\DpVolunteerPaymentPolicy',
        'App\Models\CdpTtpDonation' => 'App\Policies\CdpDonationPolicy',
        'App\Models\CdpTtpDonationPayment' => 'App\Policies\CdpDonationPaymentPolicy',
        'App\Models\AlStock' => 'App\Policies\AlStockPolicy',
        'App\Models\Vendor\Vendor' => 'App\Policies\VendorPolicy',
        'App\Models\CdpMaterialOrder' => 'App\Policies\CdpMaterialOrderPolicy',
        'App\Models\DsBankmaster' => 'App\Policies\DsBankmasterPolicy',
        'App\Models\ProjectReport\HepInitialReport' => 'App\Policies\HepInitialReportPolicy',
        'App\Models\ProjectReport\InaugurationReport' => 'App\Policies\InaugurationReportPolicy',
        'App\Models\ProjectReport\ShtpReport' => 'App\Policies\ShtpReportPolicy',
        'App\Models\Fri' => 'App\Policies\FriPolicy',
        'App\Models\CaseHistory' => 'App\Policies\CaseHistoryPolicy',
        'App\Models\TravelClaimIndent' => 'App\Policies\TravelClaimIndentPolicy',
		 'App\Models\ProjectReport\FirstHepFollowUpReport' => 'App\Policies\FirstHepFollowUpReportPolicy',
		 'App\Models\WepProject' => 'App\Policies\WepProjectPolicy',
		 'App\Models\AscEnrollment' => 'App\Policies\AscEnrollmentPolicy',
		 'App\Models\AdminIndent' => 'App\Policies\AdminIndentPolicy',
		 'App\Models\MonthlyWorkPlanner' => 'App\Policies\MonthlyWorkPlannerPolicy',
		 'App\Models\MonthlyWorkPlannerRecord' => 'App\Policies\MonthlyWorkPlannerRecordPolicy',
		 
		 'App\Models\ReliefIndentSettlement' => 'App\Policies\ReliefIndentSettlementPolicy',
		 'App\Models\EmployeeLopStatement' => 'App\Policies\EmployeeLopStatementPolicy',
		  'App\Models\ProjectBill' => 'App\Policies\ProjectPartnerBillPolicy',

	 ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

     //   Passport::routes();
    }
}
