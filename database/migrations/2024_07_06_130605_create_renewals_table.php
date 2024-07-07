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
        Schema::create('renewals', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
			$table->string('full_name')->nullable();
			$table->text('address')->nullable();
			$table->string('district')->nullable();
			$table->string('pincode')->nullable();
			$table->string('state')->nullable();
			$table->string('other_state')->nullable();
			$table->string('mobile_num')->nullable();
			$table->string('type_of_subscription')->nullable();
			$table->string('amount')->nullable();
			$table->date('date')->nullable();
			$table->string('reference_number')->nullable();
			
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
        Schema::dropIfExists('renewals');
    }
};
