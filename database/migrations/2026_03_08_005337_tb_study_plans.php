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
        //
        Schema::create('tb_study_plans', function (Blueprint $table) {
            $table->id('id_study_plan');
            $table->foreignId('fk_id_student')->constrained('users')->cascadeOnDelete();
            $table->string('day_of_week_study_plan');
            $table->string('activity_study_plan');
            $table->text('description_study_plan')->nullable();
            $table->integer('duration_study_plan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
