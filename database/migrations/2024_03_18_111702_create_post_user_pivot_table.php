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
        Schema::create('post_user', function (Blueprint $table) {
            $table->foreignId(column: 'user_id')->index();
            $table->foreign(columns: 'user_id')->on(table: 'users')->references(columns: 'id')->cascadeOnDelete();
            $table->foreignId(column: 'post_id')->index();
            $table->foreign(columns: 'post_id')->on(table: 'posts')->references(columns: 'id')->cascadeOnDelete();
            $table->primary(['post_id', 'user_id']);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_user');
    }
};
