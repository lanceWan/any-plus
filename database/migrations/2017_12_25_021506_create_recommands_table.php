<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecommandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommands', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->default(0)->comment('文章ID');
            $table->string('title')->default('')->comment('推荐文章的标题');
            $table->timestamp('push_at')->comment('文章发布时间');
            $table->integer('score')->comment('分数');
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
        Schema::dropIfExists('recommands');
    }
}
