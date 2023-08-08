<?php
/**
 * Class EmailTemplateSeeder.
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

/**
 * Class EmailTemplateSeeder
 */
class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('email_templates')->insert(
            [
                // General Email Templates
                [
                    'admin_email' => null,
                    'email_type_id' => '1',
                    'title' => 'Registration',
                    'subject' => 'Registration',
                    'content' => '
                    <p>Hello %name%!<br /> Thanks for registering at %site%. You can now login to manage your account using the following credentials:</p>
                    <ul style="margin: 0; width: 100%; float: left; list-style: none; font-size: 14px; line-height: 20px; padding: 0 0 15px;">
                    <li style="margin: 0; width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 45%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Username:</strong> <span style="width: 45%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%email%</span></li>
                    <li style="margin: 0; width: 100%; float: left; line-height: inherit; list-style-type: none;"><strong style="width: 45%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Password:</strong> <span style="width: 45%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%password%</span></li>
                    </ul>
                    <p>%signature%</p>
                    ',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'admin_email' => null,
                    'email_type_id' => '2',
                    'title' => 'Verification Code',
                    'subject' => 'Verification Code Received',
                    'content' => '
                    <p>Hello %name% !<br /> To complete your registration please add the below authentication code.</p>
                    <div style="padding: 15px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
                    <div style="padding: 15px; background: #f7f7f7; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
                    <div style="padding: 30px 15px; border: 2px solid #fff; text-align: center; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
                    <h3 style="font-size: 26px; margin-bottom: 15px; font-weight: normal; line-height: 26px; margin: 0; color: #333; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Your verification code is</h3>
                    %verification_code%</div>
                    </div>
                    </div>
                    <p>%signature%</p>
                    ',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'admin_email' => null,
                    'email_type_id' => '3',
                    'title' => 'Lost Password',
                    'subject' => 'Forgot Password',
                    'content' => '<p>Hi <strong>%name%!</strong> <strong>Lost Password reset</strong></p>
                    <p>Someone requested to reset the password of following account:<br /> <strong>Email Address:</strong> %account_email%<br /> If this was a mistake, just ignore this email and nothing will happen.<br /> To reset your password, click reset link below:<br /> <a href="%link%"><strong>Reset</strong></a></p>
                    <p>%signature%</p>',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'admin_email' => null,
                    'email_type_id' => '4',
                    'title' => 'Password Reset',
                    'subject' => 'Password Reset',
                    'content' => '
                        Hello %name%!<br/>
                        Your password has been reset successfully.<br/>
                        <ul style="margin: 0; width: 100%; float: left; list-style: none; font-size: 14px; line-height: 20px; padding: 0 0 15px; font-family: "Work Sans", Arial, Helvetica, sans-serif;">
                            <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Username:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%email%</span></li>
                            <li style="width: 100%; float: left; line-height: inherit; list-style-type: none;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Password:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%password%</span></li>
                        </ul>
                        %signature%
                    ',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                // Admin Email Templates
                [
                    'admin_email' => 'info@yourdomain.com',
                    'email_type_id' => '5',
                    'title' => 'Admin Email Content - Registration',
                    'subject' => 'New Registration!',
                    'content' => '
                        Hello <br/>
                        A new user has registered on your website. Please login to check user detail.
                        <ul style="margin: 0; width: 100%; float: left; list-style: none; font-size: 14px; line-height: 20px; padding: 0 0 15px; font-family: "Work Sans", Arial, Helvetica, sans-serif;">
                            <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Name:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%username%</span></li>
                            <li style="width: 100%; float: left; line-height: inherit; list-style-type: none;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Email:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%email%</span></li>
                        </ul>
                        %signature%',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'admin_email' => 'info@yourdomain.com',
                    'email_type_id' => '6',
                    'title' => 'Admin Email Content - Account Delete',
                    'subject' => 'Account Delete',
                    'content' => '<p>Hi, An existing user has deleted account due to following</p>
                    <p><strong>Reason:</strong> %reason%</p>
                    <p>%signature%</p>',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'admin_email' => 'info@yourdomain.com',
                    'email_type_id' => '7',
                    'title' => 'Admin Email Content - User Reported',
                    'subject' => 'User Reported',
                    'content' => '
                        Hi, <br/>
                        A %reported_user_role% has been reported by %reporter_name% with email address
                        %reporter_email%, <br/>
                        Reported user details are given below<br/>
                        <ul style="margin: 0; width: 100%; float: left; list-style: none; font-size: 14px; line-height: 20px; padding: 0 0 15px; font-family: "Work Sans", Arial, Helvetica, sans-serif;">
                            <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Name:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%reported_user_name%</span></li>
                            <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Profile URL:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%reported_user_profile%</span></li>
                            <li style="width: 100%; float: left; line-height: inherit; list-style-type: none;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Message:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%message%</span></li>
                        </ul>
                        %signature%"
                    ',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                // Users Email Templates
                [
                    'admin_email' => 'null',
                    'email_type_id' => '8',
                    'title' => 'User Email Content - User Reported',
                    'subject' => 'User Reported',
                    'content' => '
                        Hi, <br/>
                        A %reported_user_role% has been reported by you<br/>
                        Reported user details are given below<br/>
                        <ul style="margin: 0; width: 100%; float: left; list-style: none; font-size: 14px; line-height: 20px; padding: 0 0 15px; font-family: "Work Sans", Arial, Helvetica, sans-serif;">
                            <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Name:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%reported_user_name%</span></li>
                            <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Profile URL:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%reported_user_profile%</span></li>
                            <li style="width: 100%; float: left; line-height: inherit; list-style-type: none;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Message:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%message%</span></li>
                        </ul>
                        %signature%"
                    ',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'admin_email' => null,
                    'email_type_id' => '9',
                    'title' => 'User Email Content - Booking Verification Code',
                    'subject' => 'Appointment Booking Verification Code Received',
                    'content' => '
                        Hello %name% !<br/>
                        To complete your booking please add the below authentication code.
                        <div style="width: 100%; float: left; padding: 15px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
                        <div style="width: 100%; float: left; padding: 15px; background: #f7f7f7; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
                        <div style="width: 100%; float: left; padding: 30px 15px; border: 2px solid #fff; text-align: center; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
                        <h3 style="font-size: 26px; margin-bottom: 15px; font-weight: normal; line-height: 26px; margin: 0; color: #333; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; font-family: "Work Sans", Arial, Helvetica, sans-serif;">Your verification code is</h3>
                        %verification_code%
                        </div>
                        </div>
                        </div>
                        %signature%
                        ',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'admin_email' => null,
                    'email_type_id' => '10',
                    'title' => 'User Booking request',
                    'subject' => 'Appointment Booking Request',
                    'content' => '
                        Hello Dr. %doctor_name%<br/>
                        Appointment booking request is received with the following details<br/>
                        <ul style="margin: 0; width: 100%; float: left; list-style: none; font-size: 14px; line-height: 20px; padding: 0 0 15px; font-family: "Work Sans", Arial, Helvetica, sans-serif;">
                            <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Hospital Name:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%hospital_name%</span></li>
                            
                            <li style="width: 100%; float: left; line-height: inherit; list-style-type: none;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Appointment Date:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%appointment_date%</span></li>
                            
                            <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Message:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%message%</span></li>
                        </ul>
                        %signature%
                    ',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'admin_email' => null,
                    'email_type_id' => '11',
                    'title' => 'User Booking request',
                    'subject' => 'Appointment Booking Request',
                    'content' => '
                        Hello %user_name%<br/>
                        Your appointment booking request is received with the following details<br/>
                        <ul style="margin: 0; width: 100%; float: left; list-style: none; font-size: 14px; line-height: 20px; padding: 0 0 15px; font-family: "Work Sans", Arial, Helvetica, sans-serif;">
                            <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Hospital Name:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%hospital_name%</span></li>
                            
                            <li style="width: 100%; float: left; line-height: inherit; list-style-type: none;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Appointment Date:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%appointment_date%</span></li>
                            
                            <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Message:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%message%</span></li>
                        </ul>
                        %signature%
                    ',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'admin_email' => null,
                    'email_type_id' => '12',
                    'title' => 'Doctor Joining Request',
                    'subject' => 'Request Received For Joining Hospital',
                    'content' => '
                        Hello %hospital_name%,<br/>
                        <a href="%doctor_link%">%doctor_name%</a> has sent you a new request to join your hospital.<br/>
                        %signature%
                    ',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'admin_email' => null,
                    'email_type_id' => '13',
                    'title' => 'Hospital Joining Request Approved',
                    'subject' => 'Hospital Joining Request Approved',
                    'content' => '
                            Hello %doctor_name%,<br/>
                            Your request to join <a href="%hospital_link%">%hospital_name%</a> is <b>Approved</b>.<br/>
                            %signature%
                    ',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'admin_email' => null,
                    'email_type_id' => '14',
                    'title' => 'Hospital Joining Request Cancelled',
                    'subject' => 'Hospital Joining Request Cancelled',
                    'content' => '
                        Hello %doctor_name%,<br/>
                        Your request to join <a href="%hospital_link%">%hospital_name%</a> is <b>Cancelled</b>.<br/>
                        %signature%
                    ',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'admin_email' => null,
                    'email_type_id' => '15',
                    'title' => 'Package Subscribed',
                    'subject' => 'Package Subscribed',
                    'content' => '
                                Hey %doctor_name%<br/>
                                Thanks for purchasing the package. Your payment has been received and your invoice detail is given below:
                                <ul style="margin: 0; width: 100%; float: left; list-style: none; font-size: 14px; line-height: 20px; padding: 0 0 15px; font-family: "Work Sans", Arial, Helvetica, sans-serif;">
                                    <li style="width: 100%; float: left; line-height: inherit; list-style-type: none;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Package Name:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%package_name%</span></li>
                                    <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Payment Amount:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%package_price%</span></li>
                                    <li style="width: 100%; float: left; line-height: inherit; list-style-type: none;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Purchase Date:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%package_purchase_date%</span></li>
                                    <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Expiry Date:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%package_expiry%</span></li>
                                </ul>
                                %signature%
                    ',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'admin_email' => null,
                    'email_type_id' => '16',
                    'title' => 'Appointment Booking Request approved',
                    'subject' => 'Appointment Booking Request Approved',
                    'content' => '
                        Hello %user_name%<br/>
                        Your appointment booking request is approved with the following appointment details<br/>
                        <ul style="margin: 0; width: 100%; float: left; list-style: none; font-size: 14px; line-height: 20px; padding: 0 0 15px; font-family: "Work Sans", Arial, Helvetica, sans-serif;">
                            <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Hospital</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;"><a href="%hospital_link%"><strong>%hospital_name%</strong></a></span></li>
                            <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Doctor</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;"><a href="%doctor_link%"><strong>%doctor_name%</strong></a></span></li>
                            <li style="width: 100%; float: left; line-height: inherit; list-style-type: none;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Appointment Date & Time:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%appointment_date_time%</span></li>
                            <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Message:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%message%</span></li>
                        </ul>
                        %signature%
                    ',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'admin_email' => null,
                    'email_type_id' => '17',
                    'title' => 'Appointment Booking Request rejected',
                    'subject' => 'Appointment Booking Request Rejected',
                    'content' => '
                        Hello %user_name%<br/>
                        Your appointment has been rejected by the %doctor_name%
                        %signature%
                    ',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
            ]
        );
    }
}
