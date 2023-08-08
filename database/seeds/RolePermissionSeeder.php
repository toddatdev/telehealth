<?php
/**
 * Class RolePermissionSeeder.
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

/**
 * Class RolePermissionSeeder
 */
class RolePermissionSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('role_has_permissions')->insert(
            [
                [
                    'permission_id' => '1',
                    'role_id' => '1',
                ],
            ]
        );
    }

}
