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
        Schema::table('users', function (Blueprint $table) {
            $table->string('prenom')->nullable()->after('name');
            $table->string('phone')->unique()->nullable();
            $table->string('birthday')->nullable();            
            $table->string('photo')->nullable();
            $table->string('compitance')->nullable();
            $table->string('devise')->default('DH');
            $table->boolean('is_admin')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('birthday');
            $table->dropColumn('salaire');
            $table->dropColumn('photo');
            $table->dropColumn('compitance');
            $table->dropColumn('devise');
            $table->dropColumn('is_admin');
        });
    }
};
