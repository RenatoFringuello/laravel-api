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
        Schema::table('projects', function (Blueprint $table) {
            //
            $table->dropColumn('author_username');
            $table->dropColumn('author_name');
            $table->dropColumn('author_lastname');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            //
            $table->string('author_username',100);
            $table->string('author_name',100);
            $table->string('author_lastname',100);
        });
    }
};
