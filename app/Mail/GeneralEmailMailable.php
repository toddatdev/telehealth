<?php
/**
 * Class GeneralEmailMailable.
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App\Mail;

use App\EmailHelper;
use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class GeneralEmailMailable
 */
class GeneralEmailMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Setting scope of the variables
     *
     * @access public
     *
     * @var string $type
     *
     * @var collection $template
     *
     * @var array $email_params
     *
     */
    public $type;
    public $template;
    public $email_params;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($type, $template, $email_params = array())
    {
        $this->type = $type;
        $this->template = $template;
        $this->email_params = $email_params;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from_email = env("MAIL_FROM_ADDRESS");
        $from_email_id = env("MAIL_FROM_NAME");
        $subject = !empty($this->template->subject) ? $this->template->subject : 'noReply';
        if ($this->type == 'verification_code') {
            $email_message = $this->prepareEmailVerificationCode($this->email_params);
        } elseif ($this->type == 'new_user') {
            $email_message = $this->prepareEmailNewRegisteredUser($this->email_params);
        } elseif ($this->type == 'user_email_appointment_booking_verification_code') {
            $email_message = $this->prepareUserEmailAppointmentBookingVerifyCode($this->email_params);
        } elseif ($this->type == 'lost_password') {
            $email_message = $this->prepareEmailLostPassword($this->email_params);
        } elseif ($this->type == 'user_email_report_user') {
            $email_message = $this->prepareUserEmailReportUser($this->email_params);
        } elseif ($this->type == 'reset_password_email') {
            $email_message = $this->prepareEmailResetPassword($this->email_params);
        } elseif ($this->type == 'user_email_appointment_request') {
            $email_message = $this->prepareUserEmailAppointmentRequest($this->email_params);
        } elseif ($this->type == 'user_email_appointment_request_approved') {
            $email_message = $this->prepareUserEmailAppointmentRequestApproved($this->email_params);
        } elseif ($this->type == 'user_email_appointment_request_approved_visitnow') {
            $email_message = $this->prepareUserEmailAppointmentRequestApprovedVisitNow($this->email_params);
        } elseif ($this->type == 'user_email_appointment_request_approved_scheduled') {
            $email_message = $this->prepareUserEmailAppointmentRequestApprovedScheduled($this->email_params);
        } elseif ($this->type == 'doctor_email_package_subscribed') {
            $email_message = $this->contactRequestMessageSent($this->email_params);
        } elseif ($this->type == 'user_email_appointment_request_rejected') {
            $email_message = $this->prepareUserEmailAppointmentRequestRejected($this->email_params);
        } else if ($this->type == 'general_email_download_application') {
            $email_message = $this->prepareGeneralEmailDownloadApplication($this->email_params);
        } else if ($this->type == 'email_change_by_admin') {
            $email_message = $this->prepareChangeByAdminEmail($this->email_params);
        } else if ($this->type == 'password_change_by_admin') {
            $email_message = $this->prepareChangeByAdminPassword($this->email_params);
        }
        $message = $this->from($from_email, $from_email_id)
            ->subject($subject)->view('emails.index')
            ->with(
                [
                    'html' => $email_message,
                ]
            );
        return $message;
    }

    /**
     * Email Verification Code
     *
     * @param array $email_params Email Parameters
     *
     * @access public
     *
     * @return string
     */
    public function prepareEmailVerificationCode($email_params)
    {
        extract($email_params);
        $code = $verification_code;
        $user_name = $name;
        $user_email = $email;
        $site_title = EmailHelper::getSiteTitle();
        $signature = EmailHelper::getSignature();
        $app_content = $this->template->content;
        $email_content_default = " Hi %name%!
                                    Thanks for registering at " . $site_title . ". Here is your verification code to complete your registration process.:
                                    Name : %name%
                                    Verification Code: %verification_code%
                                    %signature% ";
        //set default contents
        if (empty($app_content)) {
            $app_content = $email_content_default;
        }
        $app_content = str_replace("%name%", $user_name, $app_content);
        $app_content = str_replace("%email%", $user_email, $app_content);
        $app_content = str_replace("%verification_code%", $code, $app_content);
        $app_content = str_replace("%signature%", $signature, $app_content);

        $body = "";
        $body .= EmailHelper::getEmailHeader();
        $body .= $app_content;
        $body .= EmailHelper::getEmailFooter();
        return $body;
    }

    /**
     * Email Booking Verification Code
     *
     * @param array $email_params Email Parameters
     *
     * @access public
     *
     * @return string
     */
    public function prepareUserEmailAppointmentBookingVerifyCode($email_params)
    {
        extract($email_params);
        $code = $verification_code;
        $user_name = $name;
        $signature = EmailHelper::getSignature();
        $app_content = $this->template->content;
        $email_content_default = ' 
                                    Hello %name%<br>

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
                                ';
        //set default contents
        if (empty($app_content)) {
            $app_content = $email_content_default;
        }
        $app_content = str_replace("%name%", $user_name, $app_content);
        $app_content = str_replace("%verification_code%", $code, $app_content);
        $app_content = str_replace("%signature%", $signature, $app_content);

        $body = "";
        $body .= EmailHelper::getEmailHeader();
        $body .= $app_content;
        $body .= EmailHelper::getEmailFooter();
        return $body;
    }

    /**
     * Email new user
     *
     * @param array $email_params Email Parameters
     *
     * @access public
     *
     * @return string
     */
    public function prepareEmailNewRegisteredUser($email_params)
    {
        extract($email_params);
        $site_name = $site;
        $user_name = $name;
        $user_email = $email;
        $user_password = $password;
        $site_title = EmailHelper::getSiteTitle();
        $signature = EmailHelper::getSignature();
        $app_content = $this->template->content;
        $email_content_default = " Hi %name%!

                                      Thanks for registering at " . $site_title . ". You can now login to manage your account using the following credentials:

                                      Username: %name%
                                      Password: %password%
                                      Email: %email%

                                      %signature%";
        //set default contents
        if (empty($app_content)) {
            $app_content = $email_content_default;
        }
        $app_content = str_replace("%site%", $site_name, $app_content);
        $app_content = str_replace("%name%", $user_name, $app_content);
        $app_content = str_replace("%email%", $user_email, $app_content);
        $app_content = str_replace("%password%", $user_password, $app_content);
        $app_content = str_replace("%signature%", $signature, $app_content);

        $body = "";
        $body .= EmailHelper::getEmailHeader();
        $body .= $app_content;
        $body .= EmailHelper::getEmailFooter();
        return $body;
    }

    /**
     * Email change by admin
     *
     * @param array $email_params Email Parameters
     *
     * @access public
     *
     * @return string
     */
    public function prepareChangeByAdminEmail($email_params)
    {
        extract($email_params);
        $user_name = $name;
        $user_email = $email;
        $signature = EmailHelper::getSignature();
        $app_content = $this->template;
        $email_content_default = " Hello %user_name%!
                                      Your Email is change by Admin. Your can now login with new email address %email%

                                      %signature%";
        //set default contents
        if (empty($app_content)) {
            $app_content = $email_content_default;
        }
        $app_content = str_replace("%user_name%", $user_name, $app_content);
        $app_content = str_replace("%email%", $user_email, $app_content);
        $app_content = str_replace("%signature%", $signature, $app_content);

        $body = "";
        $body .= EmailHelper::getEmailHeader();
        $body .= $app_content;
        $body .= EmailHelper::getEmailFooter();
        return $body;
    }

    /**
     * Email Contact Message
     *
     * @param array $email_params Email Parameters
     *
     * @access public
     *
     * @return string
     */
    public function contactRequestMessageSent($email_params)
    {
        extract($email_params);
        $user_name = $user_name;
        $user_email = $user_email;
        $user_phone = $user_phone;
        $user_message = $user_message;

        $site_title = EmailHelper::getSiteTitle();
        $signature = EmailHelper::getSignature();
        $app_content = $this->template->content;
        $email_content_default = " Hello
					This is contact us message from users:

                                      User Name: %user_name%
                                      User Email: %user_email%
                                      Phone Number: %user_phone%
                                      Message: %user_message%
									";
        //set default contents
        if (empty($app_content)) {
            $app_content = $email_content_default;
        }
        $app_content = str_replace("%user_name%", $user_name, $app_content);
        $app_content = str_replace("%user_email%", $user_email, $app_content);
        $app_content = str_replace("%user_phone%", $user_phone, $app_content);
        $app_content = str_replace("%user_message%", $user_message, $app_content);

        $body = "";
        $body .= EmailHelper::getEmailHeader();
        $body .= $app_content;
        $body .= EmailHelper::getEmailFooter();
        return $body;
    }

    /**
     * Password change by admin
     *
     * @param array $email_params Email Parameters
     *
     * @access public
     *
     * @return string
     */
    public function prepareChangeByAdminPassword($email_params)
    {
        extract($email_params);
        $user_name = $name;
        $user_password = $password;
        $signature = EmailHelper::getSignature();
        $app_content = $this->template;
        $email_content_default = " Hello %user_name%!
                                      Your Password is change by Admin. Your can now login with new password %password%

                                      %signature%";
        //set default contents
        if (empty($app_content)) {
            $app_content = $email_content_default;
        }
        $app_content = str_replace("%user_name%", $user_name, $app_content);
        $app_content = str_replace("%password%", $user_password, $app_content);
        $app_content = str_replace("%signature%", $signature, $app_content);

        $body = "";
        $body .= EmailHelper::getEmailHeader();
        $body .= $app_content;
        $body .= EmailHelper::getEmailFooter();
        return $body;
    }

    /**
     * Email Lost Password
     *
     * @param array $email_params Email Parameters
     *
     * @access public
     *
     * @return string
     */
    public function prepareEmailLostPassword($email_params)
    {
        extract($email_params);
        $user_name = $name;
        $user_email = $email;
        $reset_link = $link;
        $signature = EmailHelper::getSignature();
        $app_content = $this->template->content;
        $email_content_default = "Hi %name%!

                                    <strong>Lost Password reset</strong>

                                    Someone requested to reset the password of following account:

                                    Email Address: %account_email%

                                    If this was a mistake, just ignore this email and nothing will happen.

                                    To reset your password, click reset link below:

                                    <a href='%link%'>Reset</a>

                                    %signature%";
        //set default contents
        if (empty($app_content)) {
            $app_content = $email_content_default;
        }
        $app_content = str_replace("%name%", $user_name, $app_content);
        $app_content = str_replace("%account_email%", $user_email, $app_content);
        $app_content = str_replace("%link%", $reset_link, $app_content);
        $app_content = str_replace("%signature%", $signature, $app_content);

        $body = "";
        $body .= EmailHelper::getEmailHeader();
        $body .= $app_content;
        $body .= EmailHelper::getEmailFooter();
        return $body;
    }

    /**
     * Email reset password
     *
     * @param array $email_params Email Parameters
     *
     * @access public
     *
     * @return string
     */
    public function prepareEmailResetPassword($email_params)
    {
        extract($email_params);
        $user_name = $name;
        $user_email = $email;
        $pass = $password;
        $signature = EmailHelper::getSignature();
        $app_content = $this->template->content;
        $email_content_default = "Hi %name%!

                                    <strong>Password Reset</strong>

                                    You have reset your password.

                                    You can now login with the following credentials

                                    Email: %email%
                                    New Password: %password%

                                    %signature%";
        //set default contents
        if (empty($app_content)) {
            $app_content = $email_content_default;
        }
        $app_content = str_replace("%name%", $user_name, $app_content);
        $app_content = str_replace("%email%", $user_email, $app_content);
        $app_content = str_replace("%password%", $pass, $app_content);
        $app_content = str_replace("%signature%", $signature, $app_content);

        $body = "";
        $body .= EmailHelper::getEmailHeader();
        $body .= $app_content;
        $body .= EmailHelper::getEmailFooter();
        return $body;
    }

    /**
     * Email user reported
     *
     * @param array $email_params Email Parameters
     *
     * @access public
     *
     * @return string
     */
    public function prepareUserEmailReportUser($email_params)
    {
        extract($email_params);
        $reported_user_name = $user_name;
        $reported_user_profile = $user_profile;
        $reported_user_role = $user_role;
        $message = $description;
        $signature = EmailHelper::getSignature();
        $app_content = $this->template->content;
        $email_content_default = "Hi,
                                    A %reported_user_role% has been reported by you,

                                    Reported user details are given below
                                    Name: %reported_user_name%
                                    Profile URL: %reported_user_profile%
                                    Message: %message%
                                    %signature%,";
        //set default contents
        if (empty($app_content)) {
            $app_content = $email_content_default;
        }
        $app_content = str_replace("%reported_user_name%", $reported_user_name, $app_content);
        $app_content = str_replace("%reported_user_profile%", $reported_user_profile, $app_content);
        $app_content = str_replace("%reported_user_role%", $reported_user_role, $app_content);
        $app_content = str_replace("%message%", $message, $app_content);
        $app_content = str_replace("%signature%", $signature, $app_content);

        $body = "";
        $body .= EmailHelper::getEmailHeader();
        $body .= $app_content;
        $body .= EmailHelper::getEmailFooter();
        return $body;
    }

    /**
     * Email Appointment Booking Request Received
     *
     * @param array $email_params Email Parameters
     *
     * @access public
     *
     * @return string
     */
    public function prepareUserEmailAppointmentRequest($email_params)
    {
        extract($email_params);
        $user = $user_name;
        $hospital = $hospital_name;
        $date = $appointment_date;
        $message = $description;
        $signature = EmailHelper::getSignature();
        $app_content = $this->template->content;
        $email_content_default = '
                                    Hello %user_name%<br/>
                                    Your appointment booking request is received with the following message<br/>
                                    <ul style="margin: 0; width: 100%; float: left; list-style: none; font-size: 14px; line-height: 20px; padding: 0 0 15px; font-family: "Work Sans", Arial, Helvetica, sans-serif;">
                                        <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Hospital Name</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%hospital_name%</span></li>
                                        <li style="width: 100%; float: left; line-height: inherit; list-style-type: none;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Appoinment date:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%appointment_date%</span></li>
                                        <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Message:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%message%</span></li>
                                    </ul>
                                    
                                    %signature%
            ';
        //set default contents
        if (empty($app_content)) {
            $app_content = $email_content_default;
        }
        $app_content = str_replace("%user_name%", $user, $app_content);
        $app_content = str_replace("%hospital_name%", $hospital, $app_content);
        $app_content = str_replace("%appointment_date%", $date, $app_content);
        $app_content = str_replace("%message%", $message, $app_content);
        $app_content = str_replace("%signature%", $signature, $app_content);

        $body = "";
        $body .= EmailHelper::getEmailHeader();
        $body .= $app_content;
        $body .= EmailHelper::getEmailFooter();
        return $body;
    }

    /**
     * Email Appointment Booking Request Approved
     *
     * @param array $email_params Email Parameters
     *
     * @access public
     *
     * @return string
     */
    public function prepareUserEmailAppointmentRequestApproved($email_params)
    {
        extract($email_params);
        $user = $user_name;
        $hospital = $hospital_name;
        $h_link = $hospital_link;
        $doctor = $doctor_name;
        $d_link = $doctor_link;
        $date_time = $appointment_date_time;
        $message = $description;
        $signature = EmailHelper::getSignature();
        $app_content = $this->template->content;
        $email_content_default = '
                                Hello %user_name%<br/>
                                Your appointment booking request is approved with the following appointment details<br/>
                                <ul style="margin: 0; width: 100%; float: left; list-style: none; font-size: 14px; line-height: 20px; padding: 0 0 15px; font-family: "Work Sans", Arial, Helvetica, sans-serif;">
                                    <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Hospital</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;"><a href="%hospital_link%"><strong>%hospital_name%</strong></a></span></li>
                                    <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Doctor</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;"><a href="%doctor_link%"><strong>%doctor_name%</strong></a></span></li>
                                    <li style="width: 100%; float: left; line-height: inherit; list-style-type: none;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Appointment Date & Time:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%appointment_date_time%</span></li>
                                    <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Message:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%message%</span></li>
                                </ul>
                                %signature%
            ';
        //set default contents
        if (empty($app_content)) {
            $app_content = $email_content_default;
        }
        $app_content = str_replace("%user_name%", $user, $app_content);
        $app_content = str_replace("%hospital_name%", $hospital, $app_content);
        $app_content = str_replace("%hospital_link%", $h_link, $app_content);
        $app_content = str_replace("%doctor_name%", $doctor, $app_content);
        $app_content = str_replace("%doctor_link%", $d_link, $app_content);
        $app_content = str_replace("%appointment_date_time%", $date_time, $app_content);
        $app_content = str_replace("%message%", $message, $app_content);
        $app_content = str_replace("%signature%", $signature, $app_content);

        $body = "";
        $body .= EmailHelper::getEmailHeader();
        $body .= $app_content;
        $body .= EmailHelper::getEmailFooter();
        return $body;
    }

    /**
     * Email Appointment Booking Request Approved Visit Now
     *
     * @param array $email_params Email Parameters
     *
     * @access public
     *
     * @return string
     */
    public function prepareUserEmailAppointmentRequestApprovedVisitNow($email_params)
    {
        extract($email_params);
        $user = $user_name;
        $hospital = $hospital_name;
        $h_link = $hospital_link;
        $doctor = $doctor_name;
        $d_link = $doctor_link;
        $message = $description;
        $signature = EmailHelper::getSignature();
        $app_content = $this->template->content;
        $email_content_default = '
                                Hello %user_name%<br/>
                                Your appointment booking request is approved with the following appointment details<br/>
                                <ul style="margin: 0; width: 100%; float: left; list-style: none; font-size: 14px; line-height: 20px; padding: 0 0 15px; font-family: "Work Sans", Arial, Helvetica, sans-serif;">
                                    <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Hospital</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;"><a href="%hospital_link%"><strong>%hospital_name%</strong></a></span></li>
                                    <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Doctor</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;"><a href="%doctor_link%"><strong>%doctor_name%</strong></a></span></li>
                                    <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Message:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%message%</span></li>
                                </ul>
                                %signature%
            ';
        //set default contents
        if (empty($app_content)) {
            $app_content = $email_content_default;
        }
        $app_content = str_replace("%user_name%", $user, $app_content);
        $app_content = str_replace("%hospital_name%", $hospital, $app_content);
        $app_content = str_replace("%hospital_link%", $h_link, $app_content);
        $app_content = str_replace("%doctor_name%", $doctor, $app_content);
        $app_content = str_replace("%doctor_link%", $d_link, $app_content);
        $app_content = str_replace("%message%", $message, $app_content);
        $app_content = str_replace("%signature%", $signature, $app_content);

        $body = "";
        $body .= EmailHelper::getEmailHeader();
        $body .= $app_content;
        $body .= EmailHelper::getEmailFooter();
        return $body;
    }

    /**
     * Email Appointment Booking Request Approved scheduled
     *
     * @param array $email_params Email Parameters
     *
     * @access public
     *
     * @return string
     */
    public function prepareUserEmailAppointmentRequestApprovedScheduled($email_params)
    {
        extract($email_params);
        $user = $user_name;
        $hospital = $hospital_name;
        $h_link = $hospital_link;
        $doctor = $doctor_name;
        $d_link = $doctor_link;
        $date_time = $appointment_date_time;
        $message = $description;
        $signature = EmailHelper::getSignature();
        $app_content = $this->template->content;
        $email_content_default = '
                                Hello %user_name%<br/>
                                Your Booking has been confirmed. <br />Please use the Meeting link below to access your appointment. <br />You will also receive a reminder on the day of your appointment <br />10 minutes prior to the scheduled start time below.<br />
                                <ul style="margin: 0; width: 100%; float: left; list-style: none; font-size: 14px; line-height: 20px; padding: 0 0 15px; font-family: "Work Sans", Arial, Helvetica, sans-serif;">
                                    <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Hospital</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;"><a href="%hospital_link%"><strong>%hospital_name%</strong></a></span></li>
                                    <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Doctor</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;"><a href="%doctor_link%"><strong>%doctor_name%</strong></a></span></li>
                                    <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Message:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%message%</span></li>
                                </ul>
                                %signature%
            ';
        //set default contents
        if (empty($app_content)) {
            $app_content = $email_content_default;
        }
        $app_content = str_replace("%user_name%", $user, $app_content);
        $app_content = str_replace("%hospital_name%", $hospital, $app_content);
        $app_content = str_replace("%hospital_link%", $h_link, $app_content);
        $app_content = str_replace("%doctor_name%", $doctor, $app_content);
        $app_content = str_replace("%doctor_link%", $d_link, $app_content);
        $app_content = str_replace("%appointment_date_time%", $date_time, $app_content);
        $app_content = str_replace("%message%", $message, $app_content);
        $app_content = str_replace("%signature%", $signature, $app_content);

        $body = "";
        $body .= EmailHelper::getEmailHeader();
        $body .= $app_content;
        $body .= EmailHelper::getEmailFooter();
        return $body;
    }

    /**
     * Email Appointment Booking Request Approved
     *
     * @param array $email_params Email Parameters
     *
     * @access public
     *
     * @return string
     */
    public function prepareUserEmailAppointmentRequestRejected($email_params)
    {
        extract($email_params);
        $user = $user_name;
        $doctor = $doctor_name;
        $signature = EmailHelper::getSignature();
        $app_content = $this->template->content;
        $email_content_default = '
                                Hello %user_name%<br/>
                                Your appointment has been rejected by the %doctor_name%
                                %signature%
            ';
        //set default contents
        if (empty($app_content)) {
            $app_content = $email_content_default;
        }
        $app_content = str_replace("%user_name%", $user, $app_content);
        $app_content = str_replace("%doctor_name%", $doctor, $app_content);
        $app_content = str_replace("%signature%", $signature, $app_content);

        $body = "";
        $body .= EmailHelper::getEmailHeader();
        $body .= $app_content;
        $body .= EmailHelper::getEmailFooter();
        return $body;
    }

    /**
     * Email new appointment location added
     *
     * @param array $email_params Email Parameters
     *
     * @access public
     *
     * @return string
     */
    public function prepareGeneralEmailDownloadApplication($email_params)
    {
        extract($email_params);
        $app_link = $download_link;
        $signature = EmailHelper::getSignature();
        $app_content = !empty($this->template->content) ? $this->template->content : '';
        $email_content_default = 'Hello!<br/>
                                    You can download application by clicking the link below 
                                    <div style="width: 100%; float: left; padding: 15px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
                                    <div style="width: 100%; float: left; padding: 15px; background: #f7f7f7; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
                                    <div style="width: 100%; float: left; padding: 30px 15px; border: 2px solid #fff; text-align: center; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
                                    <h3 style="font-size: 26px; margin-bottom: 15px; font-weight: normal; line-height: 26px; margin: 0; color: #333; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; font-family: "Work Sans", Arial, Helvetica, sans-serif;">Application download link is</h3>
                                    <a href="%download_link%">Download Application</a>
                                    </div>
                                    </div>
                                    </div>
                                    %signature%';
        //set default contents
        if (empty($app_content)) {
            $app_content = $email_content_default;
        }
        $app_content = str_replace("%download_link%", $app_link, $app_content);
        $app_content = str_replace("%signature%", $signature, $app_content);

        $body = "";
        $body .= EmailHelper::getEmailHeader();
        $body .= $app_content;
        $body .= EmailHelper::getEmailFooter();
        return $body;
    }
}
