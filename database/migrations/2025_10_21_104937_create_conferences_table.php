<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('conferences', function (Blueprint $table) {
            $table->increments('id');
			
			$table->string('conference_title')->nullable();
			$table->string('full_name')->nullable();
			$table->string('email')->nullable();
			$table->string('mode_of_payment')->nullable(); 
			
			 
			$table->string('gender')->nullable();
			$table->string('mobile_no')->nullable();
			$table->string('recommender_type')->nullable();
			$table->string('utr_number')->nullable();
			$table->date('payment_date')->nullable();
			$table->string('region')->nullable();
			$table->string('uesi_district_hyd')->nullable();
			$table->string('uesi_district_rr')->nullable();
			 
			$table->string('recommender_name')->nullable();
			$table->string('recommender_mobile')->nullable();
			$table->string('category')->nullable();
			$table->string('attending_as')->nullable();
			$table->string('spouse_name')->nullable();
			$table->string('spouse_contact')->nullable();
			$table->integer('children_count')->nullable();
			$table->integer('children_count_below_15')->nullable();
			$table->integer('children_count_above_15')->nullable();
			$table->string('child_1_name')->nullable();
			$table->string('child_2_name')->nullable();
			$table->string('child_3_name')->nullable();
			$table->string('registration_fee')->nullable();
			$table->date('transaction_date')->nullable();
			$table->string('transaction_channel')->nullable();
			$table->string('transaction_utr')->nullable();
			$table->text('transaction_remarks')->nullable();

		 
			$table->integer('updated_by')->unsigned()->nullable();
			$table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
			$table->softDeletes(); 
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conferences');
    }
};
