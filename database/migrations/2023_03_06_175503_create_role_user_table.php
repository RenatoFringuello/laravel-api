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
        Schema::create('role_user', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')
                    ->references('id')
                    ->on('roles');
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users');

            $table->primary(['role_id','user_id']);
            
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
        Schema::table('project_technology', function (Blueprint $table) {
            //
            $table->dropForeign('role_user_role_id_foreign');
            $table->dropColumn('role_id');
            $table->dropForeign('role_user_user_id_foreign');
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('role_user');
    }
};
