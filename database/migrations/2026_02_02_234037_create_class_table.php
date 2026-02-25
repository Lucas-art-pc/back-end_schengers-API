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
        Schema::create('tb_class', function (Blueprint $table) {
            $table->id('id_class');
            $table->string('title_class');
            $table->uuid('public_id');
            $table->string('slug_class')->after('public_id');
            $table->text('description_class');
            $table->text('explication_class');
            $table->integer('duration_class');
            $table->string('url_class');
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
        Schema::dropIfExists('tb_class');
    }
};
