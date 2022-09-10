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
        Schema::create('collaborateurs', function (Blueprint $table) {
            $table->id();
            $table->float('salaire')->nullable();
            $table->string('compitance')->nullable();
            $table->string('theme')->nullable();
            $table->string('disponible')->nullable();
            $table->integer('score')->default('40');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->boolean('is_freelancer')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collaborateurs');
    }
};
