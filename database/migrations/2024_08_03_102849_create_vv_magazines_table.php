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
        Schema::create('vv_magazines', function (Blueprint $table) {
            $table->id();
			$table->string('name_of_the_file')->nullable();
			$table->string('cover_page')->nullable();
			$table->string('magazine_month')->nullable();
			$table->string('magazine_year')->nullable();
			$table->string('magazine_copy')->nullable();
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
        Schema::dropIfExists('vv_magazines');
    }
};
