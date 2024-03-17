<?php

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use HasFactory, Notifiable;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->json(column: 'body')->nullable();
            $table->foreignId(column: 'user_id');
            $table->foreign(columns: 'user_id')->on(table: 'users')->references(columns: 'id')->cascadeOnDelete();
            $table->foreignId(column: 'post_id');
            $table->foreign(columns: 'post_id')->on(table: 'posts')->references(columns: 'id')->cascadeOnDelete();

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
        Schema::dropIfExists('comments');
    }
};
