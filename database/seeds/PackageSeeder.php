<?php
/**
 * Class PackageSeeder.
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
 * Class PackageSeeder
 */
class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages')->insert(
            [
                [
                    'title' => 'Trial Package',
                    'subtitle' => '30 Days Trial',
                    'slug' => 'trial-package',
                    'cost' => '0.00',
                    'trial' => '1',
                    'options' => 'a:8:{s:14:"no_of_services";s:2:"10";s:15:"no_of_brochures";s:2:"20";s:14:"no_of_articles";s:2:"30";s:12:"no_of_awards";s:2:"25";s:17:"no_of_memberships";s:2:"28";s:8:"duration";s:2:"10";s:8:"bookings";s:4:"true";s:12:"private_chat";s:4:"true";}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Basic',
                    'subtitle' => 'Extended Plan For Managers',
                    'slug' => 'basic',
                    'cost' => '25.00',
                    'trial' => '0',
                    'options' => 'a:8:{s:14:"no_of_services";s:2:"50";s:15:"no_of_brochures";s:2:"25";s:14:"no_of_articles";s:2:"10";s:12:"no_of_awards";s:2:"15";s:17:"no_of_memberships";s:2:"20";s:8:"duration";s:2:"10";s:8:"bookings";s:4:"true";s:12:"private_chat";s:4:"true";}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Standard',
                    'subtitle' => 'Starter Plan For Newbie',
                    'slug' => 'standard',
                    'cost' => '90.00',
                    'trial' => '0',
                    'options' => 'a:8:{s:14:"no_of_services";s:2:"50";s:15:"no_of_brochures";s:2:"25";s:14:"no_of_articles";s:2:"10";s:12:"no_of_awards";s:2:"15";s:17:"no_of_memberships";s:2:"20";s:8:"duration";s:2:"30";s:8:"bookings";s:4:"true";s:12:"private_chat";s:4:"true";}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'title' => 'Premium',
                    'subtitle' => 'Popular Plan For Professionals',
                    'slug' => 'premium',
                    'cost' => '120.00',
                    'trial' => '0',
                    'options' => 'a:9:{s:14:"no_of_services";s:2:"50";s:15:"no_of_brochures";s:2:"25";s:14:"no_of_articles";s:2:"10";s:12:"no_of_awards";s:2:"15";s:17:"no_of_memberships";s:2:"20";s:8:"duration";s:3:"360";s:8:"bookings";s:4:"true";s:12:"private_chat";s:4:"true";s:8:"featured";s:4:"true";}',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
            ]
        );
    }
}
