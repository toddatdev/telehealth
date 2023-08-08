<?php

/**
 * Class CategorySeeder.
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
 * Class CategorySeeder
 */
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(
            [
                [
                    'title' => 'General Practitioner',
                    'slug'  => 'anesthesiology',
                    'image'  => null,
                    'abstract'  => 'Consectetur adipisicing elitaed eiusmod tempor incididuatna labore et dolore magna.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Dermatology',
                    'slug'  => 'dermatology',
                    'image'  => null,
                    'abstract'  => 'Consectetur adipisicing elitaed eiusmod tempor incididuatna labore et dolore magna.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Diagnostic radiology',
                    'slug'  => 'diagnostic-radiology',
                    'image'  => null,
                    'abstract'  => 'Consectetur adipisicing elitaed eiusmod tempor incididuatna labore et dolore magna.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Emergency medicine',
                    'slug'  => 'emergency-medicine',
                    'image'  => null,
                    'abstract'  => 'Consectetur adipisicing elitaed eiusmod tempor incididuatna labore et dolore magna.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Family medicine',
                    'slug'  => 'family-medicine',
                    'image'  => null,
                    'abstract'  => 'Consectetur adipisicing elitaed eiusmod tempor incididuatna labore et dolore magna.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
            ]
        );
    }
}
