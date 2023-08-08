<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'user_metas',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('user_id')->nullable();
                $table->text('experiences')->nullable();
                $table->text('specializations')->nullable();
                $table->text('memberships')->nullable();
                $table->text('educations')->nullable();
                $table->text('awards')->nullable();
                $table->text('services')->nullable();
                $table->string('avatar')->nullable();
                $table->string('banner')->nullable();
                $table->string('gender')->nullable();
                $table->string('gender_title')->nullable();
                $table->string('sub_heading')->nullable();
                $table->string('tagline')->nullable();
                $table->string('short_desc')->nullable();
                $table->text('description')->nullable();
                $table->string('delete_reason')->nullable();
                $table->string('delete_description')->nullable();
                $table->string('payout_id')->nullable();
                $table->text('profile_searchable')->nullable('true');
                $table->text('weekly_alerts')->nullable('true');
                $table->text('disable_account')->nullable('false');
                $table->text('message_alerts')->nullable('false');
                $table->text('verify_medical')->nullable();
                $table->integer('consultation_fee')->nullable();
                $table->text('saved_hospitals')->nullable();
                $table->text('saved_doctors')->nullable();
                $table->text('saved_articles')->nullable();
                $table->text('downloads')->nullable();
                $table->string('address')->nullable();
                $table->string('longitude')->nullable();
                $table->string('latitude')->nullable();
                $table->boolean('verify_registration')->default(0);
                $table->integer('recommendation')->nullable();
                $table->integer('votes')->nullable();
                $table->text('available_days')->nullable();
                $table->text('working_time')->nullable();
                $table->text('liked_answers')->nullable();
                $table->integer('starting_price')->nullable();
                $table->text('payout_settings')->nullable();
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
        Schema::dropIfExists('user_metas');
    }
}
