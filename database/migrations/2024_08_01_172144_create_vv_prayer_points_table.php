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
        Schema::create('vv_prayer_points', function (Blueprint $table) {
            $table->id();
			$table->string('vv_month')->nullable();
			$table->string('vv_year')->nullable();
			$table->string('attachment_1')->nullable();
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
        Schema::dropIfExists('vv_prayer_points');
    }
};
