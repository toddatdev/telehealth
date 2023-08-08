<?php
/**
 * Class AppointmentSeeder.
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
 * Class AppointmentSeeder
 */
class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current_date = Carbon::now();
        DB::table('appointments')->insert(
            [
                [
                    'user_id' => 2,
                    'hospital_id' => 3,
                    'patient_id' => 4,
                    'patient_name' => null,
                    'relation' => null,
                    'services' => 'a:2:{i:0;a:2:{s:10:"speciality";s:1:"1";s:7:"service";a:1:{i:0;s:1:"1";}}i:1;a:2:{s:10:"speciality";s:1:"2";s:7:"service";a:1:{i:1;s:1:"4";}}}',
                    'comments' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'appointment_time' => '2:02 am',
                    'appointment_date' => $current_date->year.'-'.$current_date->month.'-'.$current_date->day,
                    'charges' => '10000',
                    'status' => 'accepted',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 5,
                    'hospital_id' => 13,
                    'patient_id' => 21,
                    'patient_name' => null,
                    'relation' => null,
                    'services' => 'a:2:{i:0;a:2:{s:10:"speciality";s:1:"1";s:7:"service";a:1:{i:0;s:1:"1";}}i:1;a:2:{s:10:"speciality";s:1:"2";s:7:"service";a:1:{i:1;s:1:"4";}}}',
                    'comments' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'appointment_time' => '2:02 am',
                    'appointment_date' => $current_date->year.'-'.$current_date->month.'-'.$current_date->day,
                    'charges' => '8000',
                    'status' => 'accepted',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 6,
                    'hospital_id' => 14,
                    'patient_id' => 22,
                    'patient_name' => null,
                    'relation' => null,
                    'services' => 'a:2:{i:0;a:2:{s:10:"speciality";s:1:"1";s:7:"service";a:1:{i:0;s:1:"1";}}i:1;a:2:{s:10:"speciality";s:1:"2";s:7:"service";a:1:{i:1;s:1:"4";}}}',
                    'comments' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'appointment_time' => '2:02 am',
                    'appointment_date' => $current_date->year.'-'.$current_date->month.'-'.$current_date->day,
                    'charges' => '8000',
                    'status' => 'accepted',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 7,
                    'hospital_id' => 15,
                    'patient_id' => 23,
                    'patient_name' => null,
                    'relation' => null,
                    'services' => 'a:2:{i:0;a:2:{s:10:"speciality";s:1:"1";s:7:"service";a:1:{i:0;s:1:"1";}}i:1;a:2:{s:10:"speciality";s:1:"2";s:7:"service";a:1:{i:1;s:1:"4";}}}',
                    'comments' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'appointment_time' => '2:02 am',
                    'appointment_date' => $current_date->year.'-'.$current_date->month.'-'.$current_date->day,
                    'charges' => '8000',
                    'status' => 'accepted',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'user_id' => 8,
                    'hospital_id' => 16,
                    'patient_id' => 24,
                    'patient_name' => null,
                    'relation' => null,
                    'services' => 'a:2:{i:0;a:2:{s:10:"speciality";s:1:"1";s:7:"service";a:1:{i:0;s:1:"1";}}i:1;a:2:{s:10:"speciality";s:1:"2";s:7:"service";a:1:{i:1;s:1:"4";}}}',
                    'comments' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'appointment_time' => '2:02 am',
                    'appointment_date' => $current_date->year.'-'.$current_date->month.'-'.$current_date->day,
                    'charges' => '8000',
                    'status' => 'accepted',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
            ]
        );
    }
}
