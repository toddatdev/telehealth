<?php
/**
 * Class SpecialitySeeder.
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
 * Class SpecialitySeeder
 */
class SpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specialities')->insert(
            [
                [
                    'title' => 'General Practitioner',
                    'slug' => 'allergy-immunology',
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'image' => '1570521832-Allergy-Immunology.png',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Anesthesiology',
                    'slug' => 'anesthesiology',
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'image' => '1570521864-Anesthesiology.png',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Dermatology',
                    'slug' => 'dermatology',
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'image' => '1570521870-Dermatology.png',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Diagnostic radiology',
                    'slug' => 'diagnostic-radiology',
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'image' => '1570521933-Diagnostic-radiology.png',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Emergency medicine',
                    'slug' => 'emergency-medicine',
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'image' => '1570521969-img-04.png',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Family medicine',
                    'slug' => 'family-medicine',
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'image' => '1570521980-Family-medicine.png',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Internal medicine',
                    'slug' => 'internal-medicine',
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'image' => '1570521998-img-02.png',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Medical genetics',
                    'slug' => 'medical-genetics',
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'image' => '1570522011-Medical-genetics.png',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Neurology',
                    'slug' => 'neurology',
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'image' => '1570522041-img-08.png',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Nuclear medicine',
                    'slug' => 'nuclear-medicine',
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'image' => '1570522051-img-07.png',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Obstetrics and gynecology',
                    'slug' => 'obstetrics-and-gynecology',
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'image' => '1570522079-img-10.png',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Ophthalmology',
                    'slug' => 'ophthalmology',
                    'description' => '1569056281-img-09.png',
                    'image' => '1570522091-Physical-medicine -rehabilitation.png',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Psychiatry',
                    'slug' => 'psychiatry',
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'image' => '1570522104-Psychiatry.png',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Surgery',
                    'slug' => 'surgery',
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'image' => '1570522115-img-09.png',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Urology',
                    'slug' => 'urology',
                    'description' => 'Excepteur sint occaecat cupidatat non proident, saeunt in culpa qui officia cupidatat.',
                    'image' => '1570522126-Urology.png',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
            ]
        );
    }
}
