<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGalleryToUserMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'user_metas',
            function (Blueprint $table) {
                $table->text('gallery')->nullable();
                $table->text('gallery_videos')->nullable();
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
        Schema::table(
            'user_metas',
            function (Blueprint $table) {
                $table->dropColumn('gallery');
                $table->dropColumn('gallery_videos');
            }
        );
    }
}
