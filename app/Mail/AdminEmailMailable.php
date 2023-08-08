<?php
/**
 * Class AdminEmailMailable.
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
 * Class AdminEmailMailable
 */
class AdminEmailMailable extends Mailable
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
        if ($this->type == 'admin_email_registration') {
            $email_message = $this->prepareAdminEmailRegisteredUser($this->email_params);
        } elseif ($this->type == 'admin_email_delete_account') {
            $email_message = $this->prepareAdminEmailDeleteUser($this->email_params);
        } elseif ($this->type == 'admin_email_report_user') {
            $email_message = $this->prepareAdminEmailReportUser($this->email_params);
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
     * Email new user
     *
     * @param array $email_params Email Parameters
     *
     * @access public
     *
     * @return string
     */
    public function prepareAdminEmailRegisteredUser($email_params)
    {
        extract($email_params);
        $user_name = $name;
        $user_email = $email;
        $profile_link = $link;
        $signature = EmailHelper::getSignature();
        $app_content = $this->template->content;
        $email_content_default =    "Hey!

                                    A new user %username% with email address %email% has registered on your website. Please login to check user detail.

                                    You can check user detail at: %link%

                                    %signature%";
        //set default contents
        if (empty($app_content)) {
            $app_content = $email_content_default;
        }
        $app_content = str_replace("%username%", $user_name, $app_content);
        $app_content = str_replace("%email%", $user_email, $app_content);
        $app_content = str_replace("%link%", $profile_link, $app_content);
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
     * Email user reported
     *
     * @param array $email_params Email Parameters
     *
     * @access public
     *
     * @return string
     */
    public function prepareAdminEmailReportUser($email_params)
    {
        extract($email_params);
        $reported_user_name = $user_name;
        $reported_user_profile = $user_profile;
        $reported_user_role = $user_role;
        $reporter_name = $name;
        $reporter_email = $email;
        $message = $description;
        $signature = EmailHelper::getSignature();
        $app_content = $this->template->content;
        $email_content_default =    "Hi,
                                    A %reported_user_role% has been reported by %reporter_name% with email address
                                    %reporter_email%,

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
        $app_content = str_replace("%reporter_name%", $reporter_name, $app_content);
        $app_content = str_replace("%reporter_email%", $reporter_email, $app_content);
        $app_content = str_replace("%message%", $message, $app_content);
        $app_content = str_replace("%signature%", $signature, $app_content);

        $body = "";
        $body .= EmailHelper::getEmailHeader();
        $body .= $app_content;
        $body .= EmailHelper::getEmailFooter();
        return $body;
    }

}
