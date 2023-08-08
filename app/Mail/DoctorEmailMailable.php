<?php
/**
 * Class DoctorEmailMailable.
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
 * Class DoctorEmailMailable
 */
class DoctorEmailMailable extends Mailable
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
        $subject = !empty($this->template->subject) ? $this->template->subject : '';
        if ($this->type == 'doctor_email_appointment_request_received') {
            $email_message = $this->prepareDoctorEmailAppointmentRequestReceived($this->email_params);
        } else if ($this->type == 'doctor_email_appointment_request_approved') {
            $email_message = $this->prepareDoctorEmailAppointmentRequestApproved($this->email_params);
        } else if ($this->type == 'doctor_email_appointment_request_received_visitnow') {
            $email_message = $this->prepareDoctorEmailAppointmentRequestReceivedVisitNow($this->email_params);
        } else if ($this->type == 'doctor_email_appointment_request_received_scheduled') {
            $email_message = $this->prepareDoctorEmailAppointmentRequestReceivedScheduled($this->email_params);
        } else if ($this->type == 'doctor_email_doctor_request_approved') {
            $email_message = $this->prepareDoctorEmailHospitalJoiningRequestApproved($this->email_params);
        } else if ($this->type == 'doctor_email_doctor_request_cancelled') {
            $email_message = $this->prepareDoctorEmailHospitalJoiningRequestCancelled($this->email_params);
        } else if ($this->type == 'doctor_email_package_subscribed') {
            $email_message = $this->prepareDoctorEmailPackageSubscribed($this->email_params);
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
     * Email Appointment Booking Request Received
     *
     * @param array $email_params Email Parameters
     *
     * @access public
     *
     * @return string
     */
    public function prepareDoctorEmailAppointmentRequestReceived($email_params)
    {
        extract($email_params);
        $doctor = $doctor_name;
        $hospital = $hospital_name;
        $date = $appointment_date;
        $message = $description;
        $video_link = $video_link;
        $video_link_title = $video_link_title;
        $signature = EmailHelper::getSignature();
        $app_content = $this->template->content;
        $email_content_default = '
                            Hello Dr. %doctor_name%<br/>
                            Appointment booking request is received with the following details<br/>
                            <ul style="margin: 0; width: 100%; float: left; list-style: none; font-size: 14px; line-height: 20px; padding: 0 0 15px; font-family: "Work Sans", Arial, Helvetica, sans-serif;">
                                <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Hospital Name:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%hospital_name%</span></li>

				<li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Meeting Link:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;"><a href="%video_link%">%video_link_title%</a></span></li>

                                <li style="width: 100%; float: left; line-height: inherit; list-style-type: none;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Appointment Date:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%appointment_date%</span></li>
                                
                                <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Message:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%message%</span></li>
                            </ul>
                            %signature%
        ';
        //set default contents
        if (empty($app_content)) {
            $app_content = $email_content_default;
        }
        $app_content = str_replace("%doctor_name%", $doctor, $app_content);
        $app_content = str_replace("%hospital_name%", $hospital, $app_content);
        $app_content = str_replace("%appointment_date%", $date, $app_content);
        $app_content = str_replace("%message%", $message, $app_content);
        $app_content = str_replace("%video_link%", $video_link, $app_content);
        $app_content = str_replace("%video_link_title%", $video_link_title, $app_content);
        $app_content = str_replace("%signature%", $signature, $app_content);

        $body = "";
        $body .= EmailHelper::getEmailHeader();
        $body .= $app_content;
        $body .= EmailHelper::getEmailFooter();
        return $body;
    }

    /**
     * Email Appointment Booking Request Received VisitNow
     *
     * @param array $email_params Email Parameters
     *
     * @access public
     *
     * @return string
     */
    public function prepareDoctorEmailAppointmentRequestReceivedVisitNow($email_params)
    {
        extract($email_params);
        $doctor = $doctor_name;
        $hospital = $hospital_name;
        $message = $description;
        $video_link = $video_link;
        $video_link_title = $video_link_title;
        $signature = EmailHelper::getSignature();
        $app_content = $this->template->content;
        $email_content_default = '
                            Hello Dr. %doctor_name%<br/>
                            Appointment booking request is received with the following details<br/>
                            <ul style="margin: 0; width: 100%; float: left; list-style: none; font-size: 14px; line-height: 20px; padding: 0 0 15px; font-family: "Work Sans", Arial, Helvetica, sans-serif;">
                                <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Hospital Name:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%hospital_name%</span></li>

				<li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Meeting Link:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;"><a href="%video_link%">%video_link_title%</a></span></li>

                                <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Message:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%message%</span></li>
                            </ul>
                            %signature%
        ';
        //set default contents
        if (empty($app_content)) {
            $app_content = $email_content_default;
        }
        $app_content = str_replace("%doctor_name%", $doctor, $app_content);
        $app_content = str_replace("%hospital_name%", $hospital, $app_content);
        $app_content = str_replace("%message%", $message, $app_content);
        $app_content = str_replace("%video_link%", $video_link, $app_content);
        $app_content = str_replace("%video_link_title%", $video_link_title, $app_content);
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
    public function prepareDoctorEmailAppointmentRequestApproved($email_params)
    {
        extract($email_params);
        $user = $user_name;
        $hospital = $hospital_name;
        $h_link = $hospital_link;
        $doctor = $doctor_name;
        $date_time = $appointment_date_time;
        $message = $description;
        $signature = EmailHelper::getSignature();
        $app_content = $this->template->content;
        $email_content_default = '
                                Hello %user_name%<br/>
                                This is a reminder your Appointment will commence in 10 minutes. <br /> Please click on the Meeting Link below to access your booking.
                                <ul style="margin: 0; width: 100%; float: left; list-style: none; font-size: 14px; line-height: 20px; padding: 0 0 15px; font-family: "Work Sans", Arial, Helvetica, sans-serif;">
                                    <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Hospital</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;"><a href="%hospital_link%"><strong>%hospital_name%</strong></a></span></li>
                                    <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Doctor</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;"><strong>%doctor_name%</strong></span></li>
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
     * Email Appointment Booking Request Received Scheduled
     *
     * @param array $email_params Email Parameters
     *
     * @access public
     *
     * @return string
     */
    public function prepareDoctorEmailAppointmentRequestReceivedScheduled($email_params)
    {
        extract($email_params);
        $doctor = $doctor_name;
        $hospital = $hospital_name;
        $date = $appointment_date;
        $message = $description;
        $video_link = $video_link;
        $video_link_title = $video_link_title;
        $signature = EmailHelper::getSignature();
        $app_content = $this->template->content;
        $email_content_default = '
                            Hello Dr. %doctor_name%<br/>
                            Appointment booking request is received with the following details<br/>
                            <ul style="margin: 0; width: 100%; float: left; list-style: none; font-size: 14px; line-height: 20px; padding: 0 0 15px; font-family: "Work Sans", Arial, Helvetica, sans-serif;">
                                <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Hospital Name:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%hospital_name%</span></li>

				<li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Meeting Link:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;"><a href="%video_link%">%video_link_title%</a></span></li>

                                <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Message:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%message%</span></li>
                            </ul>
                            %signature%
        ';
        //set default contents
        if (empty($app_content)) {
            $app_content = $email_content_default;
        }
        $app_content = str_replace("%doctor_name%", $doctor, $app_content);
        $app_content = str_replace("%hospital_name%", $hospital, $app_content);
        $app_content = str_replace("%appointment_date%", $date, $app_content);
        $app_content = str_replace("%message%", $message, $app_content);
        $app_content = str_replace("%video_link%", $video_link, $app_content);
        $app_content = str_replace("%video_link_title%", $video_link_title, $app_content);
        $app_content = str_replace("%signature%", $signature, $app_content);

        $body = "";
        $body .= EmailHelper::getEmailHeader();
        $body .= $app_content;
        $body .= EmailHelper::getEmailFooter();
        return $body;
    }

    /**
     * Email Hospital Joining Request Approved
     *
     * @param array $email_params Email Parameters
     *
     * @access public
     *
     * @return string
     */
    public function prepareDoctorEmailHospitalJoiningRequestApproved($email_params)
    {
        extract($email_params);
        $doctor = $doctor_name;
        $hospital = $hospital_name;
        $h_link = $hospital_link;
        $signature = EmailHelper::getSignature();
        $app_content = $this->template->content;
        $email_content_default = '
                                    Hello %doctor_name%,<br/>
                                    Your request to join <a href="%hospital_link%">%hospital_name%</a> is <b>Approved</b>.<br/>
                                    %signature%,<br/>
        ';
        //set default contents
        if (empty($app_content)) {
            $app_content = $email_content_default;
        }
        $app_content = str_replace("%doctor_name%", $doctor, $app_content);
        $app_content = str_replace("%hospital_name%", $hospital, $app_content);
        $app_content = str_replace("%hospital_link%", $h_link, $app_content);
        $app_content = str_replace("%signature%", $signature, $app_content);

        $body = "";
        $body .= EmailHelper::getEmailHeader();
        $body .= $app_content;
        $body .= EmailHelper::getEmailFooter();
        return $body;
    }

    /**
     * Email Hospital Joining Request Cancelled
     *
     * @param array $email_params Email Parameters
     *
     * @access public
     *
     * @return string
     */
    public function prepareDoctorEmailHospitalJoiningRequestCancelled($email_params)
    {
        extract($email_params);
        $doctor = $doctor_name;
        $hospital = $hospital_name;
        $h_link = $hospital_link;
        $signature = EmailHelper::getSignature();
        $app_content = $this->template->content;
        $email_content_default = '
                                    Hello %doctor_name%,<br/>
                                    Your request to join <a href="%hospital_link%">%hospital_name%</a> is <b>Cancelled</b>.<br/>
                                    %signature%,<br/>
        ';
        //set default contents
        if (empty($app_content)) {
            $app_content = $email_content_default;
        }
        $app_content = str_replace("%doctor_name%", $doctor, $app_content);
        $app_content = str_replace("%hospital_name%", $hospital, $app_content);
        $app_content = str_replace("%hospital_link%", $h_link, $app_content);
        $app_content = str_replace("%signature%", $signature, $app_content);

        $body = "";
        $body .= EmailHelper::getEmailHeader();
        $body .= $app_content;
        $body .= EmailHelper::getEmailFooter();
        return $body;
    }

    /**
     * Email Hospital Joining Request Cancelled
     *
     * @param array $email_params Email Parameters
     *
     * @access public
     *
     * @return string
     */
    public function prepareDoctorEmailPackageSubscribed($email_params)
    {
        extract($email_params);
        $doctor = $doctor_name;
        $pkg_name = $pkg_title;
        $pkg_amount = $amount;
        $purchase_date = $date;
        $expiry_date = $expiry_date;
        $signature = EmailHelper::getSignature();
        $app_content = $this->template->content;
        $email_content_default = '
                        Hey %doctor_name%<br/>
                        Thanks for purchasing the package. Your payment has been received and your invoice detail is given below:
                        <ul style="margin: 0; width: 100%; float: left; list-style: none; font-size: 14px; line-height: 20px; padding: 0 0 15px; font-family: "Work Sans", Arial, Helvetica, sans-serif;">
                            <li style="width: 100%; float: left; line-height: inherit; list-style-type: none;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Package Name:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%package_name%</span></li>
                            <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Payment Amount:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%package_price%</span></li>
                            <li style="width: 100%; float: left; line-height: inherit; list-style-type: none;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Purchase Date:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%package_purchase_date%</span></li>
                            <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">Expiry Date:</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%package_expiry%</span></li>
                        </ul>
                        %signature%
        ';
        //set default contents
        if (empty($app_content)) {
            $app_content = $email_content_default;
        }
        $app_content = str_replace("%doctor_name%", $doctor, $app_content);
        $app_content = str_replace("%package_name%", $pkg_name, $app_content);
        $app_content = str_replace("%package_price%", $pkg_amount, $app_content);
        $app_content = str_replace("%package_purchase_date%", $purchase_date, $app_content);
        $app_content = str_replace("%package_expiry%", $expiry_date, $app_content);
        $app_content = str_replace("%signature%", $signature, $app_content);

        $body = "";
        $body .= EmailHelper::getEmailHeader();
        $body .= $app_content;
        $body .= EmailHelper::getEmailFooter();
        return $body;
    }
}
