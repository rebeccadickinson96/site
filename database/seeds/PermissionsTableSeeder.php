<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['id' => 1, 'name' => 'manage-all-posts', 'display_name' => 'Manage All Posts', 'created_at' => Carbon::now()],
            ['id' => 2, 'name' => 'manage-own-posts', 'display_name' => 'Manage Own Posts', 'created_at' => Carbon::now()],
            ['id' => 3, 'name' => 'manage-categories', 'display_name' => 'Manage Categories', 'created_at' => Carbon::now()],
            ['id' => 4, 'name' => 'delete-categories', 'display_name' => 'Delete Categories', 'created_at' => Carbon::now()],
            ['id' => 5, 'name' => 'manage-users', 'display_name' => 'Manage Users', 'created_at' => Carbon::now()],
            ['id' => 6, 'name' => 'manage-reports', 'display_name' => 'Manage Reports', 'created_at' => Carbon::now()],
        ]);
    }
}
