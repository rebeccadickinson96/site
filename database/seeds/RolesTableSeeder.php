<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'admin', 'display_name' => 'Admin', 'description' => 'Has access to everything', 'created_at' => Carbon::now()],
            ['id' => 2, 'name' => 'subscriber', 'display_name' => 'Subscriber', 'description' => 'Has access to their own posts and the categories', 'created_at' => Carbon::now()],
        ]);
    }
}
