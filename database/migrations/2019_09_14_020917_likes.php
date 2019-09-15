<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Likes extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('likes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id_from')->unsigned()->index();
            $table->bigInteger('user_id_to')->unsigned()->index();
            $table->boolean('seen')->default(false);
            $table->timestamps();

            $table->foreign('user_id_from')->references('id')
                ->on('users')->onDelete('cascade');
            
            $table->foreign('user_id_to')->references('id')
                ->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('likes', function (Blueprint $table) {
            $table->dropForeign(['user_id_from']);
            $table->dropForeign(['user_id_to']);
        });

        Schema::dropIfExists('likes');
    }
}
