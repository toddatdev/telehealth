<?php
/**
 * Class PayoutSeeder.
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * Class PayoutSeeder
 */
class PayoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payouts')->insert(
            [
                [
                    'amount' => 10000,
                    'payment_method' => 'Paypal',
                    'currency' => 'USD',
                    'status' => 'pending',
                    'payout_detail' => 'a:2:{s:4:"type";s:6:"paypal";s:12:"paypal_email";s:21:"yourdomain@domain.com";}',
                    'user_id' => 2,
                    'order_id' => 9,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'amount' => 8000,
                    'payment_method' => 'Direct Bank Transfer',
                    'currency' => 'USD',
                    'status' => 'pending',
                    'payout_detail' => 'a:7:{s:4:"type";s:4:"bacs";s:17:"bank_account_name";s:14:"Account Number";s:19:"bank_account_number";s:21:"xxx-xxxx-xxxxx-xxxxxx";s:9:"bank_name";s:9:"Bank Name";s:19:"bank_routing_number";s:18:"xx-xxx-xxx-xxx-xxx";s:9:"bank_iban";s:18:"xx-xxx-xxx-xxx-xxx";s:14:"bank_bic_swift";s:18:"xx-xxx-xxx-xxx-xxx";}',
                    'user_id' => 5,
                    'order_id' => 10,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'amount' => 8000,
                    'payment_method' => 'Paypal',
                    'currency' => 'USD',
                    'status' => 'pending',
                    'payout_detail' => 'a:2:{s:4:"type";s:6:"paypal";s:12:"paypal_email";s:21:"yourdomain@domain.com";}',
                    'user_id' => 6,
                    'order_id' => 11,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'amount' => 8000,
                    'payment_method' => 'Direct Bank Transfer',
                    'currency' => 'USD',
                    'status' => 'pending',
                    'payout_detail' => 'a:7:{s:4:"type";s:4:"bacs";s:17:"bank_account_name";s:14:"Account Number";s:19:"bank_account_number";s:21:"xxx-xxxx-xxxxx-xxxxxx";s:9:"bank_name";s:9:"Bank Name";s:19:"bank_routing_number";s:18:"xx-xxx-xxx-xxx-xxx";s:9:"bank_iban";s:18:"xx-xxx-xxx-xxx-xxx";s:14:"bank_bic_swift";s:18:"xx-xxx-xxx-xxx-xxx";}',
                    'user_id' => 7,
                    'order_id' => 12,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'amount' => 8000,
                    'payment_method' => 'Direct Bank Transfer',
                    'currency' => 'USD',
                    'status' => 'pending',
                    'payout_detail' => 'a:7:{s:4:"type";s:4:"bacs";s:17:"bank_account_name";s:14:"Account Number";s:19:"bank_account_number";s:21:"xxx-xxxx-xxxxx-xxxxxx";s:9:"bank_name";s:9:"Bank Name";s:19:"bank_routing_number";s:18:"xx-xxx-xxx-xxx-xxx";s:9:"bank_iban";s:18:"xx-xxx-xxx-xxx-xxx";s:14:"bank_bic_swift";s:18:"xx-xxx-xxx-xxx-xxx";}',
                    'user_id' => 8,
                    'order_id' => 13,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                
                
            ]
        );
    }
}
