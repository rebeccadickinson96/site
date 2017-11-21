<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_permissions')->insert([
            ['role_id' => 1, 'permission_id' => 1, 'created_at' => Carbon::now()],
            ['role_id' => 1, 'permission_id' => 2, 'created_at' => Carbon::now()],
            ['role_id' => 1, 'permission_id' => 3, 'created_at' => Carbon::now()],
            ['role_id' => 1, 'permission_id' => 4, 'created_at' => Carbon::now()],
            ['role_id' => 1, 'permission_id' => 5, 'created_at' => Carbon::now()],
            ['role_id' => 1, 'permission_id' => 6, 'created_at' => Carbon::now()],
            ['role_id' => 2, 'permission_id' => 2, 'created_at' => Carbon::now()],
            ['role_id' => 2, 'permission_id' => 3, 'created_at' => Carbon::now()],
        ]);
    }
}
