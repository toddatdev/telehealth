<?php
/**
 * Class FeedbackSeeder.
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
 * Class FeedbackSeeder
 */
class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feedbacks')->insert(
            [
                [
                    'waiting_time' => 2,
                    'rating' => 'a:4:{i:0;a:2:{s:6:"rating";i:4;s:6:"reason";i:1;}i:1;a:2:{s:6:"rating";i:5;s:6:"reason";i:2;}i:2;a:2:{s:6:"rating";i:5;s:6:"reason";i:3;}i:3;a:2:{s:6:"rating";i:5;s:6:"reason";i:4;}}',
                    'avg_rating' => 4.75,
                    'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'patient_id' => 4,
                    'keep_anonymous' => 'off',
                    'user_id' => 2,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'waiting_time' => 3,
                    'rating' => 'a:4:{i:0;a:2:{s:6:"rating";i:4;s:6:"reason";i:1;}i:1;a:2:{s:6:"rating";i:5;s:6:"reason";i:2;}i:2;a:2:{s:6:"rating";i:5;s:6:"reason";i:3;}i:3;a:2:{s:6:"rating";i:5;s:6:"reason";i:4;}}',
                    'avg_rating' => 2.5,
                    'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'patient_id' => 21,
                    'user_id' => 2,
                    'keep_anonymous' => 'on',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'waiting_time' => 2,
                    'rating' => 'a:4:{i:0;a:2:{s:6:"rating";i:4;s:6:"reason";i:1;}i:1;a:2:{s:6:"rating";i:5;s:6:"reason";i:2;}i:2;a:2:{s:6:"rating";i:5;s:6:"reason";i:3;}i:3;a:2:{s:6:"rating";i:5;s:6:"reason";i:4;}}',
                    'avg_rating' => 4.75,
                    'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'patient_id' => 22,
                    'keep_anonymous' => 'off',
                    'user_id' => 5,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'waiting_time' => 3,
                    'rating' => 'a:4:{i:0;a:2:{s:6:"rating";i:4;s:6:"reason";i:1;}i:1;a:2:{s:6:"rating";i:5;s:6:"reason";i:2;}i:2;a:2:{s:6:"rating";i:5;s:6:"reason";i:3;}i:3;a:2:{s:6:"rating";i:5;s:6:"reason";i:4;}}',
                    'avg_rating' => 2.5,
                    'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'patient_id' => 23,
                    'user_id' => 5,
                    'keep_anonymous' => 'on',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'waiting_time' => 2,
                    'rating' => 'a:4:{i:0;a:2:{s:6:"rating";i:4;s:6:"reason";i:1;}i:1;a:2:{s:6:"rating";i:5;s:6:"reason";i:2;}i:2;a:2:{s:6:"rating";i:5;s:6:"reason";i:3;}i:3;a:2:{s:6:"rating";i:5;s:6:"reason";i:4;}}',
                    'avg_rating' => 1,
                    'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'patient_id' => 24,
                    'keep_anonymous' => 'on',
                    'user_id' => 6,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'waiting_time' => 3,
                    'rating' => 'a:4:{i:0;a:2:{s:6:"rating";i:4;s:6:"reason";i:1;}i:1;a:2:{s:6:"rating";i:5;s:6:"reason";i:2;}i:2;a:2:{s:6:"rating";i:5;s:6:"reason";i:3;}i:3;a:2:{s:6:"rating";i:5;s:6:"reason";i:4;}}',
                    'avg_rating' => 2.5,
                    'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'patient_id' => 21,
                    'user_id' => 6,
                    'keep_anonymous' => 'on',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'waiting_time' => 2,
                    'rating' => 'a:4:{i:0;a:2:{s:6:"rating";i:4;s:6:"reason";i:1;}i:1;a:2:{s:6:"rating";i:5;s:6:"reason";i:2;}i:2;a:2:{s:6:"rating";i:5;s:6:"reason";i:3;}i:3;a:2:{s:6:"rating";i:5;s:6:"reason";i:4;}}',
                    'avg_rating' => 4.75,
                    'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'patient_id' => 22,
                    'keep_anonymous' => 'off',
                    'user_id' => 7,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'waiting_time' => 3,
                    'rating' => 'a:4:{i:0;a:2:{s:6:"rating";i:4;s:6:"reason";i:1;}i:1;a:2:{s:6:"rating";i:5;s:6:"reason";i:2;}i:2;a:2:{s:6:"rating";i:5;s:6:"reason";i:3;}i:3;a:2:{s:6:"rating";i:5;s:6:"reason";i:4;}}',
                    'avg_rating' => 2.5,
                    'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'patient_id' => 23,
                    'user_id' => 7,
                    'keep_anonymous' => 'off',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'waiting_time' => 2,
                    'rating' => 'a:4:{i:0;a:2:{s:6:"rating";i:4;s:6:"reason";i:1;}i:1;a:2:{s:6:"rating";i:5;s:6:"reason";i:2;}i:2;a:2:{s:6:"rating";i:5;s:6:"reason";i:3;}i:3;a:2:{s:6:"rating";i:5;s:6:"reason";i:4;}}',
                    'avg_rating' => 4.75,
                    'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'patient_id' => 24,
                    'keep_anonymous' => 'off',
                    'user_id' => 8,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'waiting_time' => 3,
                    'rating' => 'a:4:{i:0;a:2:{s:6:"rating";i:4;s:6:"reason";i:1;}i:1;a:2:{s:6:"rating";i:5;s:6:"reason";i:2;}i:2;a:2:{s:6:"rating";i:5;s:6:"reason";i:3;}i:3;a:2:{s:6:"rating";i:5;s:6:"reason";i:4;}}',
                    'avg_rating' => 2.5,
                    'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'patient_id' => 22,
                    'user_id' => 8,
                    'keep_anonymous' => 'off',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'waiting_time' => 2,
                    'rating' => 'a:4:{i:0;a:2:{s:6:"rating";i:4;s:6:"reason";i:1;}i:1;a:2:{s:6:"rating";i:5;s:6:"reason";i:2;}i:2;a:2:{s:6:"rating";i:5;s:6:"reason";i:3;}i:3;a:2:{s:6:"rating";i:5;s:6:"reason";i:4;}}',
                    'avg_rating' => 4.75,
                    'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'patient_id' => 21,
                    'keep_anonymous' => 'off',
                    'user_id' => 9,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'waiting_time' => 3,
                    'rating' => 'a:4:{i:0;a:2:{s:6:"rating";i:4;s:6:"reason";i:1;}i:1;a:2:{s:6:"rating";i:5;s:6:"reason";i:2;}i:2;a:2:{s:6:"rating";i:5;s:6:"reason";i:3;}i:3;a:2:{s:6:"rating";i:5;s:6:"reason";i:4;}}',
                    'avg_rating' => 2.5,
                    'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'patient_id' => 24,
                    'user_id' => 9,
                    'keep_anonymous' => 'on',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'waiting_time' => 2,
                    'rating' => 'a:4:{i:0;a:2:{s:6:"rating";i:4;s:6:"reason";i:1;}i:1;a:2:{s:6:"rating";i:5;s:6:"reason";i:2;}i:2;a:2:{s:6:"rating";i:5;s:6:"reason";i:3;}i:3;a:2:{s:6:"rating";i:5;s:6:"reason";i:4;}}',
                    'avg_rating' => 2,
                    'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'patient_id' => 23,
                    'keep_anonymous' => 'off',
                    'user_id' => 10,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
            ]
        );
    }
}
