<?php
/**
 * Class HospitalEmailMailable.
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
 * Class HospitalEmailMailable
 */
class HospitalEmailMailable extends Mailable
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
        $email_message = '';
        if ($this->type == 'hospital_appointment_locations_added') {
            $email_message = $this->prepareHospitalEmailAppointmentLocationsAdded($this->email_params);
        } else if ($this->type == 'hospital_email_doctor_request_to_hospital') {
            $email_message = $this->prepareHospitalEmailJoiningRequestReceived($this->email_params);
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
     * Email new appointment location added
     *
     * @param array $email_params Email Parameters
     *
     * @access public
     *
     * @return string
     */
    public function prepareHospitalEmailAppointmentLocationsAdded($email_params)
    {
        extract($email_params);
        $start_time = $starttime;
        $end_time = $endtime;
        $intervals = $appt_intervals;
        $duration = $appt_duration;
        $days = $appt_days;
        $signature = EmailHelper::getSignature();
        $app_content = !empty($this->template->content) ? $this->template->content : '';
        $email_content_default =    "Hey!

                                    A new appointment location has been added.
                                    Details are<br>
                                    Start Time: %starttime%<br>
                                    End Time: %endtime%<br>
                                    Intervals: %appt_intervals%<br>
                                    Duration: %appt_duration%<br>
                                    Days: %appt_days%<br>

                                    %signature%";
        //set default contents
        if (empty($app_content)) {
            $app_content = $email_content_default;
        }
        $app_content = str_replace("%starttime%", $start_time, $app_content);
        $app_content = str_replace("%endtime%", $end_time, $app_content);
        $app_content = str_replace("%appt_intervals%", $intervals, $app_content);
        $app_content = str_replace("%appt_duration%", $duration, $app_content);
        $app_content = str_replace("%appt_days%", $days, $app_content);
        $app_content = str_replace("%signature%", $signature, $app_content);

        $body = "";
        $body .= EmailHelper::getEmailHeader();
        $body .= $app_content;
        $body .= EmailHelper::getEmailFooter();
        return $body;
    }

    /**
     * Email user deleted
     *
     * @param array $email_params Email Parameters
     *
     * @access public
     *
     * @return string
     */
    public function prepareAdminEmailDeleteUser($email_params)
    {
        extract($email_params);
        $delete_reason = $reason;
        $signature = EmailHelper::getSignature();
        $app_content = $this->template->content;
        $email_content_default =    "Hi,
                                    An existing user has deleted account due to following

                                    reason: %reason%
                                    %signature%,";
        //set default contents
        if (empty($app_content)) {
            $app_content = $email_content_default;
        }
        $app_content = str_replace("%reason%", $delete_reason, $app_content);
        $app_content = str_replace("%signature%", $signature, $app_content);

        $body = "";
        $body .= EmailHelper::getEmailHeader();
        $body .= $app_content;
        $body .= EmailHelper::getEmailFooter();
        return $body;
    }

    /**
     * Email user deleted
     *
     * @param array $email_params Email Parameters
     *
     * @access public
     *
     * @return string
     */
    public function prepareHospitalEmailJoiningRequestReceived($email_params)
    {
        extract($email_params);
        $h_name = $hospital_name;
        $doc_link = $doctor_link;
        $doc_name = $doctor_name;
        $signature = EmailHelper::getSignature();
        $app_content = $this->template->content;
        $email_content_default =    '
                                Hello %hospital_name%,<br/>
                                <a href="%doctor_link%">%doctor_name%</a> has sent you a new request to join your hospital.<br/>
                                %signature%,
                            ';
        //set default contents
        if (empty($app_content)) {
            $app_content = $email_content_default;
        }
        $app_content = str_replace("%hospital_name%", $h_name, $app_content);
        $app_content = str_replace("%doctor_link%", $doc_link, $app_content);
        $app_content = str_replace("%doctor_name%", $doc_name, $app_content);
        $app_content = str_replace("%signature%", $signature, $app_content);

        $body = "";
        $body .= EmailHelper::getEmailHeader();
        $body .= $app_content;
        $body .= EmailHelper::getEmailFooter();
        return $body;
    }

}
