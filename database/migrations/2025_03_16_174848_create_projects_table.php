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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('news_smi');
            $table->text('news_social');
            $table->integer('stat_smi');
            $table->integer('stat_social');
            $table->integer('stat_neg');
            $table->integer('stat_pos');
            $table->integer('stat_neu');
            $table->integer('stat_all');
            $table->date('f_date');
            $table->date('s_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
