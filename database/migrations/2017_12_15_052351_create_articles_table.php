<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('video_id')->unsigned()->default(0)->comment('视频ID');
            $table->integer('user_id')->unsigned()->default(0)->comment('用户ID');
            $table->string('title')->default('')->comment('标题');
            $table->text('lead')->comment('摘要');
            $table->string('banner', 500)->default('')->comment('文章banner');
            $table->text('content_html')->comment('文章内容-html格式');
            $table->text('content_mark')->comment('文章内容-markdown格式');
            $table->string('meta_title')->default('')->comment('SEO标题');
            $table->string('meta_keyword')->default('')->comment('SEO关键字');
            $table->string('meta_description')->default('')->comment('SEO描述');
            $table->integer('view')->default(0)->comment('浏览量');
            $table->tinyInteger('status')->default(3)->comment('状态');
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
        Schema::dropIfExists('articles');
    }
}
