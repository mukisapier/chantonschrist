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
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->string('title');
            $table->integer('type');
            $table->text('content');
            $table->string('author')->nullable();

            $table->boolean('is_favorite')->default(false);

            $table->timestamps();

            $table->index('number');
            $table->index('type');
            $table->index('title');
            $table->index('is_favorite');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
