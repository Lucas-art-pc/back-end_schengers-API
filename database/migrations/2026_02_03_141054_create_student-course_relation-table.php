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
        Schema::create('tb_rel_student_course', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_id_course')->constrained('tb_courses', 'id_course')->cascadeOnDelete();
            $table->foreignId('fk_id_student')->constrained('users')->cascadeOnDelete();
            $table->unique(
                ['fk_id_course', 'fk_id_student'],
                'uq_relation_student_course'
            );
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
