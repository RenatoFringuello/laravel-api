<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('slug',100);
            $table->string('title',50)->unique();
            $table->string('author_username',100);
            $table->string('author_name',100);
            $table->string('author_lastname',100);
            $table->text('content',100);
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable()->default(null);
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
        //remove old images in storage
        $allImages = Storage::allFiles('images/projects');
        foreach ($allImages as $image) {
            if($image != 'images/projects/placeholder.jpg')
                Storage::delete($image);
        }

        Schema::dropIfExists('projects');
    }
};
