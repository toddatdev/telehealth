<?php

namespace App\Http\Controllers;
namespace NotificationChannels\ClickSend;

use ClickSendLib\Controllers\SMSController;
use App\Helper;
use Illuminate\Http\Request;

class NexmoSmsController extends Controller
{
    /**
     * @var SMSController
     */
    protected $clicksendSmsController;
    
    /**
     * Clicksend constructor.
     *
     * @param SMSController $clicksendSmsController
     */
    public function __construct(SMSController $clicksendSmsController)
    {
        $this->clicksendSmsController = $clicksendSmsController;
    }
    
    /**
     * Send SMS message.
     *
     * @param $message
     * @param $to
     * @return string
     * @throws \ClickSendLib\APIException
     */
    public function sendSmsMessage()
    {
        $message = $_GET['message'];
        $receiver = $_GET['receiver'];
        $payload = [
            [
                'body' => $message,
                'to' => $receiver,
            ]
        ];

        return $this->clicksendSmsController->sendSms(['messages' => $payload]);
    }
}
