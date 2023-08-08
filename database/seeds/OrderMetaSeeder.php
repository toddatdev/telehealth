<?php
/**
 * Class OrderMetaSeeder.
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
 * Class OrderMetaSeeder
 */
class OrderMetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_metas')->insert(
            [
                //Trial Purchase
                [
                    'meta_key' => 'package',
                    'meta_value' => 'a:9:{s:2:"id";i:1;s:5:"title";s:13:"Trial Package";s:8:"subtitle";s:13:"30 Days Trial";s:4:"slug";s:13:"trial-package";s:4:"cost";d:0;s:5:"trial";i:1;s:7:"options";s:270:"a:9:{s:14:"no_of_services";s:2:"10";s:15:"no_of_brochures";s:2:"20";s:14:"no_of_articles";s:2:"30";s:12:"no_of_awards";s:2:"25";s:17:"no_of_memberships";s:2:"28";s:8:"duration";s:2:"30";s:8:"bookings";s:4:"true";s:8:"featured";s:4:"true";s:12:"private_chat";s:4:"true";}";s:10:"created_at";s:19:"'.Carbon::now()->format('Y-m-d H:i:s').'";s:10:"updated_at";s:19:"'.Carbon::now()->format('Y-m-d H:i:s').'";}',
                    'metable_type' => 'App\Order',
                    'metable_id' => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'type',
                    'meta_value' => 'package',
                    'metable_type' => 'App\Order',
                    'metable_id' => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'invoice_id',
                    'meta_value' => 'xxx_xxx_xxx',
                    'metable_type' => 'App\Order',
                    'metable_id' => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'transaction_id',
                    'meta_value' => 'ah_1FOIEhGvHEQhfjqvSF8upVgV',
                    'metable_type' => 'App\Order',
                    'metable_id' => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                //Basic Purchase
                [
                    'meta_key' => 'package',
                    'meta_value' => 'a:9:{s:2:"id";i:2;s:5:"title";s:5:"Basic";s:8:"subtitle";s:26:"Extended Plan For Managers";s:4:"slug";s:5:"basic";s:4:"cost";d:25;s:5:"trial";i:0;s:7:"options";s:270:"a:9:{s:14:"no_of_services";s:2:"50";s:15:"no_of_brochures";s:2:"25";s:14:"no_of_articles";s:2:"10";s:12:"no_of_awards";s:2:"15";s:17:"no_of_memberships";s:2:"20";s:8:"duration";s:2:"10";s:8:"bookings";s:4:"true";s:8:"featured";s:4:"true";s:12:"private_chat";s:4:"true";}";s:10:"created_at";s:19:"'.Carbon::now()->format('Y-m-d H:i:s').'";s:10:"updated_at";s:19:"'.Carbon::now()->format('Y-m-d H:i:s').'";}',
                    'metable_type' => 'App\Order',
                    'metable_id' => 2,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'type',
                    'meta_value' => 'package',
                    'metable_type' => 'App\Order',
                    'metable_id' => 2,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'invoice_id',
                    'meta_value' => 'xxx_xxx_xxx',
                    'metable_type' => 'App\Order',
                    'metable_id' => 2,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'transaction_id',
                    'meta_value' => 'bh_1FOIEhGvHEQhfjqvSF8upVgV',
                    'metable_type' => 'App\Order',
                    'metable_id' => 2,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                //Standard Purchase
                [
                    'meta_key' => 'package',
                    'meta_value' => 'a:9:{s:2:"id";i:3;s:5:"title";s:8:"Standard";s:8:"subtitle";s:23:"Starter Plan For Newbie";s:4:"slug";s:8:"standard";s:4:"cost";d:90;s:5:"trial";i:0;s:7:"options";s:270:"a:9:{s:14:"no_of_services";s:2:"50";s:15:"no_of_brochures";s:2:"25";s:14:"no_of_articles";s:2:"10";s:12:"no_of_awards";s:2:"15";s:17:"no_of_memberships";s:2:"20";s:8:"duration";s:2:"30";s:8:"bookings";s:4:"true";s:8:"featured";s:4:"true";s:12:"private_chat";s:4:"true";}";s:10:"created_at";s:19:"'.Carbon::now()->format('Y-m-d H:i:s').'";s:10:"updated_at";s:19:"'.Carbon::now()->format('Y-m-d H:i:s').'";}',
                    'metable_type' => 'App\Order',
                    'metable_id' => 3,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'type',
                    'meta_value' => 'package',
                    'metable_type' => 'App\Order',
                    'metable_id' => 3,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'invoice_id',
                    'meta_value' => 'xxx_xxx_xxx',
                    'metable_type' => 'App\Order',
                    'metable_id' => 3,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'transaction_id',
                    'meta_value' => 'ch_1FOIEhGvHEQhfjqvSF8upVgV',
                    'metable_type' => 'App\Order',
                    'metable_id' => 3,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                //premium Purchase
                [
                    'meta_key' => 'package',
                    'meta_value' => 'a:9:{s:2:"id";i:4;s:5:"title";s:7:"Premium";s:8:"subtitle";s:30:"Popular Plan For Professionals";s:4:"slug";s:7:"premium";s:4:"cost";d:120;s:5:"trial";i:0;s:7:"options";s:271:"a:9:{s:14:"no_of_services";s:2:"50";s:15:"no_of_brochures";s:2:"25";s:14:"no_of_articles";s:2:"10";s:12:"no_of_awards";s:2:"15";s:17:"no_of_memberships";s:2:"20";s:8:"duration";s:3:"360";s:8:"bookings";s:4:"true";s:8:"featured";s:4:"true";s:12:"private_chat";s:4:"true";}";s:10:"created_at";s:19:"'.Carbon::now()->format('Y-m-d H:i:s').'";s:10:"updated_at";s:19:"'.Carbon::now()->format('Y-m-d H:i:s').'";}',
                    'metable_type' => 'App\Order',
                    'metable_id' => 4,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'type',
                    'meta_value' => 'package',
                    'metable_type' => 'App\Order',
                    'metable_id' => 4,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'invoice_id',
                    'meta_value' => 'xxx_xxx_xxx',
                    'metable_type' => 'App\Order',
                    'metable_id' => 4,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'transaction_id',
                    'meta_value' => 'dh_1FOIEhGvHEQhfjqvSF8upVgV',
                    'metable_type' => 'App\Order',
                    'metable_id' => 4,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                //Standard Purchase
                [
                    'meta_key' => 'package',
                    'meta_value' => 'a:9:{s:2:"id";i:3;s:5:"title";s:8:"Standard";s:8:"subtitle";s:23:"Starter Plan For Newbie";s:4:"slug";s:8:"standard";s:4:"cost";d:90;s:5:"trial";i:0;s:7:"options";s:270:"a:9:{s:14:"no_of_services";s:2:"50";s:15:"no_of_brochures";s:2:"25";s:14:"no_of_articles";s:2:"10";s:12:"no_of_awards";s:2:"15";s:17:"no_of_memberships";s:2:"20";s:8:"duration";s:2:"30";s:8:"bookings";s:4:"true";s:8:"featured";s:4:"true";s:12:"private_chat";s:4:"true";}";s:10:"created_at";s:19:"'.Carbon::now()->format('Y-m-d H:i:s').'";s:10:"updated_at";s:19:"'.Carbon::now()->format('Y-m-d H:i:s').'";}',
                    'metable_type' => 'App\Order',
                    'metable_id' => 5,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'type',
                    'meta_value' => 'package',
                    'metable_type' => 'App\Order',
                    'metable_id' => 5,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'invoice_id',
                    'meta_value' => 'xxx_xxx_xxx',
                    'metable_type' => 'App\Order',
                    'metable_id' => 5,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'transaction_id',
                    'meta_value' => 'eh_1FOIEhGvHEQhfjqvSF8upVgV',
                    'metable_type' => 'App\Order',
                    'metable_id' => 5,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                //premium Purchase
                [
                    'meta_key' => 'package',
                    'meta_value' => 'a:9:{s:2:"id";i:4;s:5:"title";s:7:"Premium";s:8:"subtitle";s:30:"Popular Plan For Professionals";s:4:"slug";s:7:"premium";s:4:"cost";d:120;s:5:"trial";i:0;s:7:"options";s:271:"a:9:{s:14:"no_of_services";s:2:"50";s:15:"no_of_brochures";s:2:"25";s:14:"no_of_articles";s:2:"10";s:12:"no_of_awards";s:2:"15";s:17:"no_of_memberships";s:2:"20";s:8:"duration";s:3:"360";s:8:"bookings";s:4:"true";s:8:"featured";s:4:"true";s:12:"private_chat";s:4:"true";}";s:10:"created_at";s:19:"'.Carbon::now()->format('Y-m-d H:i:s').'";s:10:"updated_at";s:19:"'.Carbon::now()->format('Y-m-d H:i:s').'";}',
                    'metable_type' => 'App\Order',
                    'metable_id' => 6,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'type',
                    'meta_value' => 'package',
                    'metable_type' => 'App\Order',
                    'metable_id' => 6,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'invoice_id',
                    'meta_value' => 'xxx_xxx_xxx',
                    'metable_type' => 'App\Order',
                    'metable_id' => 6,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'transaction_id',
                    'meta_value' => 'fh_1FOIEhGvHEQhfjqvSF8upVgV',
                    'metable_type' => 'App\Order',
                    'metable_id' => 6,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                //Basic Purchase
                [
                    'meta_key' => 'package',
                    'meta_value' => 'a:9:{s:2:"id";i:2;s:5:"title";s:5:"Basic";s:8:"subtitle";s:26:"Extended Plan For Managers";s:4:"slug";s:5:"basic";s:4:"cost";d:25;s:5:"trial";i:0;s:7:"options";s:270:"a:9:{s:14:"no_of_services";s:2:"50";s:15:"no_of_brochures";s:2:"25";s:14:"no_of_articles";s:2:"10";s:12:"no_of_awards";s:2:"15";s:17:"no_of_memberships";s:2:"20";s:8:"duration";s:2:"10";s:8:"bookings";s:4:"true";s:8:"featured";s:4:"true";s:12:"private_chat";s:4:"true";}";s:10:"created_at";s:19:"'.Carbon::now()->format('Y-m-d H:i:s').'";s:10:"updated_at";s:19:"'.Carbon::now()->format('Y-m-d H:i:s').'";}',
                    'metable_type' => 'App\Order',
                    'metable_id' => 7,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'type',
                    'meta_value' => 'package',
                    'metable_type' => 'App\Order',
                    'metable_id' => 7,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'invoice_id',
                    'meta_value' => 'xxx_xxx_xxx',
                    'metable_type' => 'App\Order',
                    'metable_id' => 7,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'transaction_id',
                    'meta_value' => 'gh_1FOIEhGvHEQhfjqvSF8upVgV',
                    'metable_type' => 'App\Order',
                    'metable_id' => 7,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                //Trial Purchase
                [
                    'meta_key' => 'package',
                    'meta_value' => 'a:9:{s:2:"id";i:1;s:5:"title";s:13:"Trial Package";s:8:"subtitle";s:13:"30 Days Trial";s:4:"slug";s:13:"trial-package";s:4:"cost";d:0;s:5:"trial";i:1;s:7:"options";s:270:"a:9:{s:14:"no_of_services";s:2:"10";s:15:"no_of_brochures";s:2:"20";s:14:"no_of_articles";s:2:"30";s:12:"no_of_awards";s:2:"25";s:17:"no_of_memberships";s:2:"28";s:8:"duration";s:2:"30";s:8:"bookings";s:4:"true";s:8:"featured";s:4:"true";s:12:"private_chat";s:4:"true";}";s:10:"created_at";s:19:"'.Carbon::now()->format('Y-m-d H:i:s').'";s:10:"updated_at";s:19:"'.Carbon::now()->format('Y-m-d H:i:s').'";}',
                    'metable_type' => 'App\Order',
                    'metable_id' => 8,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'type',
                    'meta_value' => 'package',
                    'metable_type' => 'App\Order',
                    'metable_id' => 8,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'invoice_id',
                    'meta_value' => 'xxx_xxx_xxx',
                    'metable_type' => 'App\Order',
                    'metable_id' => 8,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'transaction_id',
                    'meta_value' => 'hh_1FOIEhGvHEQhfjqvSF8upVgV',
                    'metable_type' => 'App\Order',
                    'metable_id' => 8,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                //Appointment Booking
                [
                    'meta_key' => 'appointment',
                    'meta_value' => 'a:14:{s:2:"id";i:2;s:7:"user_id";i:2;s:11:"hospital_id";i:3;s:10:"patient_id";i:4;s:12:"patient_name";N;s:8:"relation";N;s:8:"services";s:142:"a:2:{i:0;a:2:{s:10:"speciality";s:1:"1";s:7:"service";a:1:{i:0;s:1:"1";}}i:1;a:2:{s:10:"speciality";s:1:"2";s:7:"service";a:1:{i:1;s:1:"4";}}}";s:8:"comments";s:445:"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";s:16:"appointment_time";s:7:"3:02 am";s:16:"appointment_date";s:9:"2019-10-3";s:7:"charges";i:10000;s:6:"status";s:7:"pending";s:10:"created_at";s:19:"'.Carbon::now()->format('Y-m-d H:i:s').'";s:10:"updated_at";s:19:"'.Carbon::now()->format('Y-m-d H:i:s').'";}',
                    'metable_type' => 'App\Order',
                    'metable_id' => 9,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'type',
                    'meta_value' => 'appointment',
                    'metable_type' => 'App\Order',
                    'metable_id' => 9,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'invoice_id',
                    'meta_value' => 'xxx_xxx_xxx',
                    'metable_type' => 'App\Order',
                    'metable_id' => 9,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'transaction_id',
                    'meta_value' => 'ih_1FOIEhGvHEQhfjqvSF8upVgV',
                    'metable_type' => 'App\Order',
                    'metable_id' => 9,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                //Appointment Booking
                [
                    'meta_key' => 'appointment',
                    'meta_value' => 'a:14:{s:2:"id";i:2;s:7:"user_id";i:5;s:11:"hospital_id";i:13;s:10:"patient_id";i:21;s:12:"patient_name";N;s:8:"relation";N;s:8:"services";s:142:"a:2:{i:0;a:2:{s:10:"speciality";s:1:"1";s:7:"service";a:1:{i:0;s:1:"1";}}i:1;a:2:{s:10:"speciality";s:1:"2";s:7:"service";a:1:{i:1;s:1:"4";}}}";s:8:"comments";s:445:"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";s:16:"appointment_time";s:7:"3:02 am";s:16:"appointment_date";s:9:"2019-10-3";s:7:"charges";i:8000;s:6:"status";s:7:"pending";s:10:"created_at";s:19:"'.Carbon::now()->format('Y-m-d H:i:s').'";s:10:"updated_at";s:19:"'.Carbon::now()->format('Y-m-d H:i:s').'";}',
                    'metable_type' => 'App\Order',
                    'metable_id' => 10,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'type',
                    'meta_value' => 'appointment',
                    'metable_type' => 'App\Order',
                    'metable_id' => 10,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'invoice_id',
                    'meta_value' => 'xxx_xxx_xxx',
                    'metable_type' => 'App\Order',
                    'metable_id' => 10,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'transaction_id',
                    'meta_value' => 'jh_1FOIEhGvHEQhfjqvSF8upVgV',
                    'metable_type' => 'App\Order',
                    'metable_id' => 10,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                //Appointment Booking
                [
                    'meta_key' => 'appointment',
                    'meta_value' => 'a:14:{s:2:"id";i:2;s:7:"user_id";i:6;s:11:"hospital_id";i:14;s:10:"patient_id";i:22;s:12:"patient_name";N;s:8:"relation";N;s:8:"services";s:142:"a:2:{i:0;a:2:{s:10:"speciality";s:1:"1";s:7:"service";a:1:{i:0;s:1:"1";}}i:1;a:2:{s:10:"speciality";s:1:"2";s:7:"service";a:1:{i:1;s:1:"4";}}}";s:8:"comments";s:445:"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";s:16:"appointment_time";s:7:"3:02 am";s:16:"appointment_date";s:9:"2019-10-3";s:7:"charges";i:8000;s:6:"status";s:7:"pending";s:10:"created_at";s:19:"'.Carbon::now()->format('Y-m-d H:i:s').'";s:10:"updated_at";s:19:"'.Carbon::now()->format('Y-m-d H:i:s').'";}',
                    'metable_type' => 'App\Order',
                    'metable_id' => 11,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'type',
                    'meta_value' => 'appointment',
                    'metable_type' => 'App\Order',
                    'metable_id' => 11,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'invoice_id',
                    'meta_value' => 'xxx_xxx_xxx',
                    'metable_type' => 'App\Order',
                    'metable_id' => 11,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'transaction_id',
                    'meta_value' => 'jh_1FOIEhGvHEQhfjqvSF8upVgV',
                    'metable_type' => 'App\Order',
                    'metable_id' => 11,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                //Appointment Booking
                [
                    'meta_key' => 'appointment',
                    'meta_value' => 'a:14:{s:2:"id";i:2;s:7:"user_id";i:7;s:11:"hospital_id";i:15;s:10:"patient_id";i:23;s:12:"patient_name";N;s:8:"relation";N;s:8:"services";s:142:"a:2:{i:0;a:2:{s:10:"speciality";s:1:"1";s:7:"service";a:1:{i:0;s:1:"1";}}i:1;a:2:{s:10:"speciality";s:1:"2";s:7:"service";a:1:{i:1;s:1:"4";}}}";s:8:"comments";s:445:"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";s:16:"appointment_time";s:7:"3:02 am";s:16:"appointment_date";s:9:"2019-10-3";s:7:"charges";i:8000;s:6:"status";s:7:"pending";s:10:"created_at";s:19:"'.Carbon::now()->format('Y-m-d H:i:s').'";s:10:"updated_at";s:19:"'.Carbon::now()->format('Y-m-d H:i:s').'";}',
                    'metable_type' => 'App\Order',
                    'metable_id' => 12,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'type',
                    'meta_value' => 'appointment',
                    'metable_type' => 'App\Order',
                    'metable_id' => 12,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'invoice_id',
                    'meta_value' => 'xxx_xxx_xxx',
                    'metable_type' => 'App\Order',
                    'metable_id' => 12,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'transaction_id',
                    'meta_value' => 'jh_1FOIEhGvHEQhfjqvSF8upVgV',
                    'metable_type' => 'App\Order',
                    'metable_id' => 12,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                //Appointment Booking
                [
                    'meta_key' => 'appointment',
                    'meta_value' => 'a:14:{s:2:"id";i:2;s:7:"user_id";i:8;s:11:"hospital_id";i:16;s:10:"patient_id";i:24;s:12:"patient_name";N;s:8:"relation";N;s:8:"services";s:142:"a:2:{i:0;a:2:{s:10:"speciality";s:1:"1";s:7:"service";a:1:{i:0;s:1:"1";}}i:1;a:2:{s:10:"speciality";s:1:"2";s:7:"service";a:1:{i:1;s:1:"4";}}}";s:8:"comments";s:445:"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";s:16:"appointment_time";s:7:"3:02 am";s:16:"appointment_date";s:9:"2019-10-3";s:7:"charges";i:8000;s:6:"status";s:7:"pending";s:10:"created_at";s:19:"'.Carbon::now()->format('Y-m-d H:i:s').'";s:10:"updated_at";s:19:"'.Carbon::now()->format('Y-m-d H:i:s').'";}',
                    'metable_type' => 'App\Order',
                    'metable_id' => 13,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'type',
                    'meta_value' => 'appointment',
                    'metable_type' => 'App\Order',
                    'metable_id' => 13,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'invoice_id',
                    'meta_value' => 'xxx_xxx_xxx',
                    'metable_type' => 'App\Order',
                    'metable_id' => 13,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'transaction_id',
                    'meta_value' => 'jh_1FOIEhGvHEQhfjqvSF8upVgV',
                    'metable_type' => 'App\Order',
                    'metable_id' => 13,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
            ]
        );
    }
}
