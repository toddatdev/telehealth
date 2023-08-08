<?php
/**
 * Class ServiceSeeder.
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
 * Class ServiceSeeder
 */

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert(
            [
                [
                    'title' => 'Administrative psychiatry',
                    'slug' => 'administrative-psychiatry',
                    'speciality_id' => 1,
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Adolescent medicine',
                    'slug' => 'adolescent-medicine',
                    'speciality_id' => 6,
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Aerospace medicine',
                    'slug' => 'aerospace-medicine',
                    'speciality_id' => 5,
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Anatomical pathology',
                    'slug' => 'anatomical-pathology',
                    'speciality_id' => 2,
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Anesthesiology',
                    'slug' => 'anesthesiology',
                    'speciality_id' => 3,
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Biochemical genetics',
                    'slug' => 'biochemical-genetics',
                    'speciality_id' => 8,
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Brain medicine',
                    'slug' => 'brain-medicine',
                    'speciality_id' => 9,
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Breast imaging',
                    'slug' => 'breast-imaging',
                    'speciality_id' => 4,
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Calculi',
                    'slug' => 'calculi',
                    'speciality_id' => 14,
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Cardiothoracic radiology',
                    'slug' => 'cardiothoracic-radiology',
                    'speciality_id' => 4,
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Cardiovascular',
                    'slug' => 'cardiovascular',
                    'speciality_id' => 5,
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Cardiovascular radiology',
                    'slug' => 'cardiovascular-radiology',
                    'speciality_id' => 4,
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Chemical pathology',
                    'slug' => 'chemical-pathology',
                    'speciality_id' => 1,
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Chest radiology',
                    'slug' => 'chest-radiology',
                    'speciality_id' => 4,
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Child neurology',
                    'slug' => 'child-neurology',
                    'speciality_id' => 9,
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Child psychiatry',
                    'slug' => 'child-psychiatry',
                    'speciality_id' => 14,
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],     
            ]
        );
    }
}
