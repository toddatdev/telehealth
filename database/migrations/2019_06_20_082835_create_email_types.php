<?php
/**
 * Class CreateEmailTypes.
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'email_types',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('role_id')->nullable();
                $table->enum(
                    'email_type',
                    [
                        'new_user', 'verification_code', 'lost_password',
                        'reset_password_email','admin_email_registration', 'admin_email_delete_account', 'admin_email_report_user',
                        'user_email_report_user', 'user_email_appointment_booking_verification_code', 'doctor_email_appointment_request_received',
                        'user_email_appointment_request', 'hospital_email_doctor_request_to_hospital', 'doctor_email_doctor_request_approved',
                        'doctor_email_doctor_request_cancelled', 'doctor_email_package_subscribed', 'user_email_appointment_request_approved',
                        'user_email_appointment_request_rejected'
                    ]
                );
                $table->text('variables');
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
        Schema::dropIfExists('email_types');
    }
}
