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
        Schema::create('tb_courses', function (Blueprint $table) {
            $table->id('id_course');
            $table->foreignId('fk_id_area')->constrained('tb_areas')->restrictOnDelete()->cascadeOnUpdate();
            $table->uuid('public_id');

            $table->foreignId('fk_id_teacher')
                ->constrained('tb_teacher')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->string('title_course');
            $table->string('slug_course');
            $table->text('description_course');
            $table->integer('duration_course');
            $table->boolean('active_course');
            $table->boolean('is_paid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_courses');
    }
};
