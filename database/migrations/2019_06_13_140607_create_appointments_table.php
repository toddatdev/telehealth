<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'appointments',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('user_id');
                $table->integer('hospital_id');
                $table->integer('patient_id');
                $table->string('patient_name')->nullable();
                $table->enum(
                    'relation',
                    ['father', 'mother', 'sister', 'brother', 'friend']
                )->nullable();
                $table->text('services')->nullable();
                $table->text('comments')->nullable();
                $table->string('appointment_time');
                $table->string('appointment_date');
                $table->integer('charges');
                $table->string('status');
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
        Schema::dropIfExists('appointments');
    }
}
