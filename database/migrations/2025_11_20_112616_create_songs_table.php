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
            $table->integer('type'); // 1 = Swahili (Nyimbo Za Wokovu), 2 = French (Chants de triomphe)
            $table->text('content');
            $table->string('author')->nullable();
            $table->timestamps();

            $table->index('number');
            $table->index('type');
            $table->index('title');
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
