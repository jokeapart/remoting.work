<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('jobPostings', function (Blueprint $table) {
            $table->id();
            $table->integer('employer_id');
			$table->string('title');
			$table->text('description');
			$table->string('skills_required');
			$table->text('requirements')->nullable();
			$table->string('application_status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('jobPostings');
    }
};
