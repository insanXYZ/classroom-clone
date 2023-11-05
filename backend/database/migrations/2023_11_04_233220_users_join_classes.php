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
        Schema::create("users_join_classes", function(Blueprint $table){
            $table->string("user_id")->nullable(false);
            $table->string("class_id")->nullable(false);
            $table->primary(["user_id","class_id"]);
            $table->integer("role")->default(0)->nullable(false);

            $table->foreign("user_id")->on("users")->references("id");
            $table->foreign("class_id")->on("classes")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_join_classes');
    }
};
