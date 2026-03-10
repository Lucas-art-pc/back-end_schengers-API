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
        Schema::create('tb_student_answers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('fk_id_student')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('fk_id_activity')
                ->constrained('tb_activity', 'id_activity')
                ->cascadeOnDelete();

            $table->foreignId('fk_id_alternative')
                ->constrained('tb_alternative', 'id_alternative')
                ->cascadeOnDelete();

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
