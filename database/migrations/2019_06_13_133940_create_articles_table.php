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
        Schema::create(
            'articles',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('slug');
                $table->integer('author_id');
                $table->text('tags')->nullable();
                $table->integer('views')->nullable();
                $table->integer('likes')->nullable();
                $table->string('title');
                $table->text('description');
                $table->string('image')->nullable();
                $table->string('excerpt');
                $table->boolean('is_featured')->default(false);
                $table->timestamps();
            }
        );
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
