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
        Schema::create('tb_vacancy', function (Blueprint $table) {
            $table->id('id_vacancy');
            $table->foreignId('fk_id_area')->constrained('tb_areas')->restrictOnDelete()->cascadeOnUpdate();
            $table->uuid('public_id');
            $table->string('title_vacancy');
            $table->text('description_vacancy');
            $table->text('requirements_vacancy');
            $table->text('tasks_vacancy');
            $table->string('slug_vacancy');
            $table->date('start_date_vacancy');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_vacancy');
    }
};
