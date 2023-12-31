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
        Schema::create('classes', function (Blueprint $table) {
            $table->string("id")->primary();
            $table->string("banner_img")->nullable(false);
            $table->string("color_list")->nullable(false);
            $table->string("code")->nullable(false);
            $table->string("name")->nullable(false);
            $table->string("section")->nullable();
            $table->string("subject")->nullable();
            $table->string("room")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
