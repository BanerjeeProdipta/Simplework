<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->text('excerpt');
            $table->text('body');
            $table->string('photo_name')->nullable();
            $table->unsignedBigInteger('best_reply_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade');

            // $table->foreign('best_reply_id')
            // ->references('id')->on('replies');

            //alter table `articles` add constraint `articles_best_reply_id_foreign` foreign key (`best_reply_id`) references `replies` (`id`)

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
