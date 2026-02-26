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
        Schema::create('tb_activity', function (Blueprint $table) {
            $table->id('id_activity');
            $table->string('title_activity');
            $table->uuid('public_id');
            $table->string('slug_activity')->after('public_id');
            $table->text('description_activity');
            $table->text('question_activity');

            $table->foreignId('fk_id_course')
                ->constrained('tb_courses', 'id_course')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_activity');
    }
};
