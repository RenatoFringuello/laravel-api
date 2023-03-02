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
        Schema::create('project_technology', function (Blueprint $table) {
            // $table->id();
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')
                    ->references('id')
                    ->on('projects')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
                    
            $table->unsignedBigInteger('technology_id');
            $table->foreign('technology_id')
                    ->references('id')
                    ->on('technologies')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->primary(['project_id', 'technology_id']);
            
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
            $table->dropForeign('project_technology_project_id_foreign');
            $table->dropColumn('project_id');
            $table->dropForeign('project_technology_technology_id_foreign');
            $table->dropColumn('technology_id');
        });
        Schema::dropIfExists('project_technology');
    }
};
