<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'name' => 'Rebecca Dickinson',
            'email' => 'bexy-d@hotmail.com',
            'password' => bcrypt('rebecca1996')
        ]);
    }
}
