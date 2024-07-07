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
        Schema::create('prayer_points', function (Blueprint $table) {
            $table->id();
			$table->string('full_name')->nullable();
			$table->string('email')->nullable();
			$table->string('mobile')->nullable();
			$table->string('eu_name')->nullable();
			$table->string('responsibility')->nullable();
			$table->string('region')->nullable();
			$table->string('district')->nullable();
			$table->string('place')->nullable();
			$table->text('thank_god')->nullable();
			$table->text('prayer')->nullable();
			
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
        Schema::dropIfExists('prayer_points');
    }
};
