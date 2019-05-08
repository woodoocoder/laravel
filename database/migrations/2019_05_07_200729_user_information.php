<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserInformation extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_info_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key', 120)->index()->nullable();
            $table->string('name', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('user_info_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('type_id')->unsigned();
            $table->string('name', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('type_id')->references('id')
                ->on('user_info_types')->onDelete('cascade');
        });

        Schema::create('user_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('relationship_id')->unsigned()->nullable();
            $table->bigInteger('living_id')->unsigned()->nullable();
            $table->bigInteger('children_id')->unsigned()->nullable();
            $table->bigInteger('smoking_id')->unsigned()->nullable();
            $table->bigInteger('drinking_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');

            $table->foreign('relationship_id')->references('id')
                ->on('user_info_options')->onDelete('cascade');

            $table->foreign('living_id')->references('id')
                ->on('user_info_options')->onDelete('cascade');

            $table->foreign('children_id')->references('id')
                ->on('user_info_options')->onDelete('cascade');

            $table->foreign('smoking_id')->references('id')
                ->on('user_info_options')->onDelete('cascade');

            $table->foreign('drinking_id')->references('id')
                ->on('user_info_options')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        
        Schema::dropIfExists('user_info_types');
        Schema::dropIfExists('user_info_options');
        Schema::dropIfExists('user_information');
    }
}
