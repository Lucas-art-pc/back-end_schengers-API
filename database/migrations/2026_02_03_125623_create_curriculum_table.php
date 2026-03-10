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
        Schema::create('tb_curriculum', function (Blueprint $table) {
            $table->id('id_curriculum');


            $table->foreignId('fk_id_teacher')
                ->constrained('tb_teacher')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('fk_id_vacancy')
                ->constrained('tb_vacancy', 'id_vacancy')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();


            $table->string('name');
            $table->string('email');
            $table->uuid('public_id');
            $table->string('phone');
            $table->string('linkedin')->nullable();
            $table->string('portfolio')->nullable();


            $table->enum('education_level',['graduacao', 'pos-graduacao','mestrado', 'doutorado']);
            $table->string('institution');
            $table->string('course');
            $table->year('graduation_year')->nullable();

            $table->string('url_image')->nullable();


            $table->text('professional_experience')->nullable();


            $table->text('skills');


            $table->string('personal_document');
            $table->string('professional_document');


            $table->enum('status', ['pending', 'approved', 'rejected'])
                ->default('pending');

            $table->unique(
                ['fk_id_teacher', 'fk_id_vacancy'],
                'uq_curriculum_teacher_vacancy'
            );

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculum');
    }
};
