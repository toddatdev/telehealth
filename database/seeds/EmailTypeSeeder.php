<?php
/**
 * Class EmailTypeSeeder.
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class EmailTypeSeeder
 */
class EmailTypeSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('email_types')->insert(
            [
                // General Email Types
                [
                    'role_id' => null,
                    'email_type' => 'new_user',
                    'variables' => 'a:6:{i:0;a:2:{s:3:"key";s:4:"name";s:5:"value";s:6:"%name%";}i:1;a:2:{s:3:"key";s:5:"email";s:5:"value";s:7:"%email%";}i:2;a:2:{s:3:"key";s:8:"username";s:5:"value";s:10:"%username%";}i:3;a:2:{s:3:"key";s:8:"password";s:5:"value";s:10:"%password%";}i:4;a:2:{s:3:"key";s:17:"verification_code";s:5:"value";s:19:"%verification_code%";}i:5;a:2:{s:3:"key";s:9:"signature";s:5:"value";s:11:"%signature%";}}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'role_id' => null,
                    'email_type' => 'verification_code',
                    'variables' => 'a:4:{i:0;a:2:{s:3:"key";s:4:"name";s:5:"value";s:6:"%name%";}i:1;a:2:{s:3:"key";s:5:"email";s:5:"value";s:7:"%email%";}i:2;a:2:{s:3:"key";s:17:"verification_code";s:5:"value";s:19:"%verification_code%";}i:3;a:2:{s:3:"key";s:9:"signature";s:5:"value";s:11:"%signature%";}}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'role_id' => null,
                    'email_type' => 'lost_password',
                    'variables' => 'a:3:{i:0;a:2:{s:3:"key";s:4:"name";s:5:"value";s:6:"%name%";}i:1;a:2:{s:3:"key";s:4:"link";s:5:"value";s:6:"%link%";}i:2;a:2:{s:3:"key";s:9:"signature";s:5:"value";s:11:"%signature%";}}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'role_id' => null,
                    'email_type' => 'reset_password_email',
                    'variables' => 'a:3:{i:0;a:2:{s:3:"key";s:4:"name";s:5:"value";s:6:"%name%";}i:1;a:2:{s:3:"key";s:5:"email";s:5:"value";s:7:"%email%";}i:2;a:2:{s:3:"key";s:8:"password";s:5:"value";s:10:"%password%";}}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],

                // Admin Email Types
                [
                    'role_id' => 1,
                    'email_type' => 'admin_email_registration',
                    'variables' => 'a:4:{i:0;a:2:{s:3:"key";s:8:"username";s:5:"value";s:10:"%username%";}i:1;a:2:{s:3:"key";s:4:"link";s:5:"value";s:6:"%link%";}i:2;a:2:{s:3:"key";s:5:"email";s:5:"value";s:7:"%email%";}i:3;a:2:{s:3:"key";s:9:"signature";s:5:"value";s:11:"%signature%";}}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'role_id' => 1,
                    'email_type' => 'admin_email_delete_account',
                    'variables' => 'a:5:{i:0;a:2:{s:3:"key";s:6:"reason";s:5:"value";s:8:"%reason%";}i:1;a:2:{s:3:"key";s:8:"username";s:5:"value";s:10:"%username%";}i:2;a:2:{s:3:"key";s:5:"email";s:5:"value";s:7:"%email%";}i:3;a:2:{s:3:"key";s:7:"message";s:5:"value";s:9:"%message%";}i:4;a:2:{s:3:"key";s:9:"signature";s:5:"value";s:11:"%signature%";}}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'role_id' => 1,
                    'email_type' => 'admin_email_report_user',
                    'variables' => 'a:7:{i:0;a:2:{s:3:"key";s:18:"reported_user_role";s:5:"value";s:20:"%reported_user_role%";}i:1;a:2:{s:3:"key";s:13:"reporter_name";s:5:"value";s:15:"%reporter_name%";}i:2;a:2:{s:3:"key";s:14:"reporter_email";s:5:"value";s:16:"%reporter_email%";}i:3;a:2:{s:3:"key";s:18:"reported_user_name";s:5:"value";s:20:"%reported_user_name%";}i:4;a:2:{s:3:"key";s:21:"reported_user_profile";s:5:"value";s:23:"%reported_user_profile%";}i:5;a:2:{s:3:"key";s:7:"message";s:5:"value";s:9:"%message%";}i:6;a:2:{s:3:"key";s:9:"signature";s:5:"value";s:11:"%signature%";}}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                //Regular User Email Types
                [
                    'role_id' => null,
                    'email_type' => 'user_email_report_user',
                    'variables' => 'a:5:{i:0;a:2:{s:3:"key";s:18:"reported_user_role";s:5:"value";s:20:"%reported_user_role%";}i:1;a:2:{s:3:"key";s:18:"reported_user_name";s:5:"value";s:20:"%reported_user_name%";}i:2;a:2:{s:3:"key";s:21:"reported_user_profile";s:5:"value";s:23:"%reported_user_profile%";}i:3;a:2:{s:3:"key";s:7:"message";s:5:"value";s:9:"%message%";}i:4;a:2:{s:3:"key";s:9:"signature";s:5:"value";s:11:"%signature%";}}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'role_id' => 4,
                    'email_type' => 'user_email_appointment_booking_verification_code',
                    'variables' => 'a:3:{i:0;a:2:{s:3:"key";s:4:"name";s:5:"value";s:6:"%name%";}i:1;a:2:{s:3:"key";s:17:"verification_code";s:5:"value";s:19:"%verification_code%";}i:2;a:2:{s:3:"key";s:9:"signature";s:5:"value";s:11:"%signature%";}}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'role_id' => 2,
                    'email_type' => 'doctor_email_appointment_request_received',
                    'variables' => 'a:5:{i:0;a:2:{s:3:"key";s:11:"doctor_name";s:5:"value";s:13:"%doctor_name%";}i:1;a:2:{s:3:"key";s:13:"hospital_name";s:5:"value";s:15:"%hospital_name%";}i:2;a:2:{s:3:"key";s:16:"appointment_date";s:5:"value";s:18:"%appointment_date%";}i:3;a:2:{s:3:"key";s:7:"message";s:5:"value";s:9:"%message%";}i:4;a:2:{s:3:"key";s:9:"signature";s:5:"value";s:11:"%signature%";}}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'role_id' => 4,
                    'email_type' => 'user_email_appointment_request',
                    'variables' => 'a:5:{i:0;a:2:{s:3:"key";s:9:"user_name";s:5:"value";s:11:"%user_name%";}i:1;a:2:{s:3:"key";s:13:"hospital_name";s:5:"value";s:15:"%hospital_name%";}i:2;a:2:{s:3:"key";s:16:"appointment_date";s:5:"value";s:18:"%appointment_date%";}i:3;a:2:{s:3:"key";s:7:"message";s:5:"value";s:9:"%message%";}i:4;a:2:{s:3:"key";s:9:"signature";s:5:"value";s:11:"%signature%";}}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'role_id' => 3,
                    'email_type' => 'hospital_email_doctor_request_to_hospital',
                    'variables' => 'a:4:{i:0;a:2:{s:3:"key";s:13:"hospital_name";s:5:"value";s:15:"%hospital_name%";}i:1;a:2:{s:3:"key";s:11:"doctor_link";s:5:"value";s:13:"%doctor_link%";}i:2;a:2:{s:3:"key";s:11:"doctor_name";s:5:"value";s:13:"%doctor_name%";}i:3;a:2:{s:3:"key";s:9:"signature";s:5:"value";s:11:"%signature%";}}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'role_id' => 2,
                    'email_type' => 'doctor_email_doctor_request_approved',
                    'variables' => 'a:4:{i:0;a:2:{s:3:"key";s:11:"doctor_name";s:5:"value";s:13:"%doctor_name%";}i:1;a:2:{s:3:"key";s:13:"hospital_link";s:5:"value";s:15:"%hospital_link%";}i:2;a:2:{s:3:"key";s:13:"hospital_name";s:5:"value";s:15:"%hospital_name%";}i:3;a:2:{s:3:"key";s:9:"signature";s:5:"value";s:11:"%signature%";}}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'role_id' => 2,
                    'email_type' => 'doctor_email_doctor_request_cancelled',
                    'variables' => 'a:4:{i:0;a:2:{s:3:"key";s:11:"doctor_name";s:5:"value";s:13:"%doctor_name%";}i:1;a:2:{s:3:"key";s:13:"hospital_link";s:5:"value";s:15:"%hospital_link%";}i:2;a:2:{s:3:"key";s:13:"hospital_name";s:5:"value";s:15:"%hospital_name%";}i:3;a:2:{s:3:"key";s:9:"signature";s:5:"value";s:11:"%signature%";}}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'role_id' => 2,
                    'email_type' => 'doctor_email_package_subscribed',
                    'variables' => 'a:5:{i:0;a:2:{s:3:"key";s:12:"package_name";s:5:"value";s:14:"%package_name%";}i:1;a:2:{s:3:"key";s:13:"package_price";s:5:"value";s:15:"%package_price%";}i:2;a:2:{s:3:"key";s:21:"package_purchase_date";s:5:"value";s:23:"%package_purchase_date%";}i:3;a:2:{s:3:"key";s:14:"package_expiry";s:5:"value";s:16:"%package_expiry%";}i:4;a:2:{s:3:"key";s:9:"signature";s:5:"value";s:11:"%signature%";}}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'role_id' => 4,
                    'email_type' => 'user_email_appointment_request_approved',
                    'variables' => 'a:8:{i:0;a:2:{s:3:"key";s:9:"user_name";s:5:"value";s:11:"%user_name%";}i:1;a:2:{s:3:"key";s:13:"hospital_link";s:5:"value";s:15:"%hospital_link%";}i:2;a:2:{s:3:"key";s:13:"hospital_name";s:5:"value";s:15:"%hospital_name%";}i:3;a:2:{s:3:"key";s:11:"doctor_link";s:5:"value";s:13:"%doctor_link%";}i:4;a:2:{s:3:"key";s:11:"doctor_name";s:5:"value";s:13:"%doctor_name%";}i:5;a:2:{s:3:"key";s:21:"appointment_date_time";s:5:"value";s:23:"%appointment_date_time%";}i:6;a:2:{s:3:"key";s:7:"message";s:5:"value";s:9:"%message%";}i:7;a:2:{s:3:"key";s:9:"signature";s:5:"value";s:11:"%signature%";}}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'role_id' => 4,
                    'email_type' => 'user_email_appointment_request_rejected',
                    'variables' => 'a:3:{i:0;a:2:{s:3:"key";s:9:"user_name";s:5:"value";s:11:"%user_name%";}i:1;a:2:{s:3:"key";s:11:"doctor_name";s:5:"value";s:13:"%doctor_name%";}i:2;a:2:{s:3:"key";s:9:"signature";s:5:"value";s:11:"%signature%";}}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
            ]
        );
    }
}
