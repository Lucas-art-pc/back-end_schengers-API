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
        Schema::create('tb_alternative', function (Blueprint $table) {
            $table->id('id_alternative');
            $table->string('title_alternative');
            $table->text('text_alternative');
            $table->boolean('correct_alternative');
            $table->foreignId('fk_id_activity')->constrained('tb_activity', 'id_activity')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alternative');
    }
};
