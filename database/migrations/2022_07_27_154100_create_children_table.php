<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->increments("id");
            $table->string("name");
            $table->enum("gender", ['Male', 'Female']);
            $table->unsignedDouble('age');
            $table->unsignedBigInteger("parent_id");
            $table->timestamps();

            $table->foreign("parent_id")
                ->references("id")
                ->on("users")
                ->onDelete("No Action");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('children');
    }
};
