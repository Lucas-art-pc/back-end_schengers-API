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
        Schema::create('tb_areas', function (Blueprint $table) {
            $table->id();
            $table->string('name_area');
            $table->string('slug_area');
            $table->string('icon_area');
            $table->string('color_area'); // Precisa estar de acordo com cores do REACT predefinidas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('areas');
    }
};
