<?php
/**
 * Class OrderSeeder.
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
 * Class OrderSeeder
 */
class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current_date = Carbon::now();
        DB::table('orders')->insert(
            [
                [
                    'payment_gateway' => 'paypal',
                    'appointment_date' => null,
                    'status' => 'completed',
                    'user_id' => 2,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'payment_gateway' => 'paypal',
                    'appointment_date' => null,
                    'status' => 'completed',
                    'user_id' => 5,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'payment_gateway' => 'paypal',
                    'appointment_date' => null,
                    'status' => 'completed',
                    'user_id' => 6,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'payment_gateway' => 'paypal',
                    'appointment_date' => null,
                    'status' => 'completed',
                    'user_id' => 7,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'payment_gateway' => 'paypal',
                    'appointment_date' => null,
                    'status' => 'completed',
                    'user_id' => 8,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'payment_gateway' => 'paypal',
                    'appointment_date' => null,
                    'status' => 'completed',
                    'user_id' => 9,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'payment_gateway' => 'paypal',
                    'appointment_date' => null,
                    'status' => 'completed',
                    'user_id' => 10,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'payment_gateway' => 'paypal',
                    'appointment_date' => null,
                    'status' => 'completed',
                    'user_id' => 11,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'payment_gateway' => 'paypal',
                    'appointment_date' => $current_date->year.'-'.$current_date->month.'-'.$current_date->day,
                    'status' => 'completed',
                    'user_id' => 4,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'payment_gateway' => 'paypal',
                    'appointment_date' => $current_date->year.'-'.$current_date->month.'-'.$current_date->day,
                    'status' => 'completed',
                    'user_id' => 21,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'payment_gateway' => 'paypal',
                    'appointment_date' => $current_date->year.'-'.$current_date->month.'-'.$current_date->day,
                    'status' => 'completed',
                    'user_id' => 22,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'payment_gateway' => 'paypal',
                    'appointment_date' => $current_date->year.'-'.$current_date->month.'-'.$current_date->day,
                    'status' => 'completed',
                    'user_id' => 23,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'payment_gateway' => 'paypal',
                    'appointment_date' => $current_date->year.'-'.$current_date->month.'-'.$current_date->day,
                    'status' => 'completed',
                    'user_id' => 24,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
            ]
        );
    }
}
