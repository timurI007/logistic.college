<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('presentations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('chapter_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            
            $table->string('title');
            $table->timestamps();
        });        
        
        DB::statement("ALTER TABLE presentations AUTO_INCREMENT = 12345;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presentations');
    }
};
