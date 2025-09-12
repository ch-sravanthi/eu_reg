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
        Schema::create('egf_basic_infos', function (Blueprint $table) {
            $table->id();
			$table->string('code')->nullable();
			$table->string('year')->nullable();
			$table->string('region')->nullable();
			$table->string('district')->nullable();  
			$table->string('revenue_division')->nullable();
			$table->string('egf_name')->nullable();
			$table->string('egf_status')->nullable();
			$table->string('egf_committee_formed')->nullable();
			$table->string('status')->nullable(); 
			
            $table->integer('created_by')->unsigned()->nullable(); 
			$table->foreign('created_by')->references('id')->on('users');
			$table->integer('updated_by')->unsigned()->nullable();
			$table->foreign('updated_by')->references('id')->on('users');
			$table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egf_basic_infos');
    }
};
