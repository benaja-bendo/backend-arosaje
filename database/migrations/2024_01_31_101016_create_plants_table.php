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
        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->default(null);
            $table->string('description')->nullable()->default(null);
            $table->text('path_image');
            $table->unsignedBigInteger('user_created');
            $table->date('date_begin')->nullable()->default(null);
            $table->date('date_end')->nullable()->default(null);
            $table->boolean('is_published')->default(false);
            $table->foreign('user_created')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plants');
    }
};
