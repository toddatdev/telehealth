<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Log;

class PatientHasEnteredTheirWaitingRoom extends Notification
{
    use Queueable;

    private $meetingLink;
    private $appointment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($appointment, $meetingLink)
    {
        $this->appointment = $appointment;
        $this->meetingLink = $meetingLink;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $patient = User::find($this->appointment['patient_id']);

        $postdata = http_build_query(
            array(
                'phonenumber' => "+923376135359",
                'message' => "Hello, Patient has entered their waiting room. Meeting Link: {$this->meetingLink}, Patient: {$patient->first_name} Appointment Time: {$this->appointment['appointment_date']} {$this->appointment['appointment_time']} Thank you From Telehealth Plus https://telehealthplus.com.au"
            )
        );
        $opts = array('http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );

        $message = "Hello {$notifiable->first_name},\r\nThe patient '{$patient->first_name}' has entered your waiting room.\r\nAppointment Time: {$this->appointment['appointment_date']} {$this->appointment['appointment_time']}\r\nClick below to join the meeting\r\n$this->meetingLink\r\nRegards,\r\n Telehealth Plus https://telehealthplus.com.au";
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://rest.clicksend.com/v3/sms/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode([
                "messages" => [
                    [
                        "body" => $message,
                        "to" => $notifiable->phonenumber,
                        "from" => "+61400279944"
                    ]
                ]
            ]),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Basic aGVsbG9Acmlja3NoZW1wb2lsLmNvbTowRTAzQ0M1My05RjJFLUQyQ0ItREZDQi1FNEY5RDUwNTY0RTM='
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        Log::info('SMS Response', [$response]);

        return (new MailMessage)
            ->line("Hello {$notifiable->first_name},")
            ->line("The patient '{$patient->first_name}' has entered your waiting room.")
            ->line("Appointment Time: {$this->appointment['appointment_date']} {$this->appointment['appointment_time']}")
            ->line("Click below to join the meeting")
            ->line("$this->meetingLink");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
