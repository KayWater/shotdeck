<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shots', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('thumbnail');
            $table->string('film');
            $table->string('duration');
            $table->string('genre')->nullable();
            $table->string('director')->nullable();
            $table->string('actors')->nullable();
            $table->string('roles_and_gender')->nullable();
            $table->string('color')->nullable();
            $table->string('color_system')->nullable();
            $table->string('time_of_day')->nullable();
            $table->string('lighting')->nullable();
            $table->string('lighting_type')->nullable();
            $table->string('shot_type')->nullable();
            $table->string('camera_angle')->nullable();
            $table->string('camera_movement')->nullable();
            $table->string('lens_language')->nullable();
            $table->string('aspect_ratio')->nullable();
            $table->string('viewpoint')->nullable();

            $table->string('tags');
            
            $table->unsignedBigInteger('user_id')->nullable();
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
        Schema::dropIfExists('shots');
    }
}
