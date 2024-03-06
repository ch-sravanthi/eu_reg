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
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
			$table->string('blog_title')->nullable();
			$table->string('category')->nullable();
			$table->string('location')->nullable();
			$table->text('description')->nullable();
			$table->date('last_date')->nullable();
			$table->string('image_1')->nullable();
			$table->string('image_2')->nullable();
			$table->string('status')->default('created');
					
			$table->string('person_name')->nullable();
			$table->string('person_mobile')->nullable();
			$table->string('person_email', 80)->nullable();
		//	$table->foreignId('updated_by')->nullable()->constrained('users');
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
        Schema::dropIfExists('blogs');
    }
};
