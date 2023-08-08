<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Validator;
// use Illuminate\Notifications\Notification;
// use ClickSend\ClickSendMessage;
// use ClickSend\ClickSendChannel;

class BulkSmsController extends Controller
{
    public function sendSms( Request $request )
    {
    //   // Your Account SID and Auth Token from twilio.com/console
    //   $sid    = env( 'TWILIO_SID' );
    //   $token  = env( 'TWILIO_TOKEN' );
    //   $client = new Client( $sid, $token );

    //   $validator = Validator::make($request->all(), [
    //       'numbers' => 'required',
    //       'message' => 'required'
    //   ]);

    //   if ( $validator->passes() ) {

    //       $numbers_in_arrays = explode( ',' , $request->input( 'numbers' ) );

    //       $message = $request->input( 'message' );
    //       $count = 0;

    //       foreach( $numbers_in_arrays as $number )
    //       {
    //           $count++;

    //           $client->messages->create(
    //               $number,
    //               [
    //                   'from' => env( 'TWILIO_FROM' ),
    //                   'body' => $message,
    //               ]
    //           );
    //       }

    //       return back()->with( 'success', $count . " messages sent!" );
              
    //   } else {
    //       return back()->withErrors( $validator );
    //   }
    
            $postdata = http_build_query(
                array(
                    'phonenumber' => '+61400279944',
                    'message' => 'Hello Your Booking has been confirmed. Meeting Link: https://us05web.zoom.us/j/2804449604?pwd=KzNJNDFpNW8xbXdNYnlFOXFGYWdZdz09 Doctor:Laury Nic Appointment Time: 2021-8-15 11:45 pm Thank you  From Telehealth Plus http://telehealthplus.com.au'
                )
            );
            $opts = array('http' =>
                array(
                    'method'  => 'GET',
                    'header'  => 'Content-Type: application/x-www-form-urlencoded',
                    'content' => $postdata
                )
            );
            $context  = stream_context_create($opts);
            $SMScall_patient = file_get_contents('https://txmarketvalue.com/Clicksend/apicall.php?'.$postdata, false, $context);
            echo $SMScall_patient;
   }
}
