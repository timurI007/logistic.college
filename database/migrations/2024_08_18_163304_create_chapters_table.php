<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();

            $table->foreignId('course_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('chapters')
                ->cascadeOnDelete();
            
            $table->string('title');
            $table->string('subtitle');
            $table->timestamps();
        });
        
        DB::statement("ALTER TABLE chapters AUTO_INCREMENT = 1234;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
