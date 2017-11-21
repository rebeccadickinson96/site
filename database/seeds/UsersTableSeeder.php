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
            'password' => bcrypt('Password1'),
            'role_id' => 1
        ]);

        factory(App\User::class)->create([
            'name' => 'Jane Doe',
            'email' => 'blogsitesub@hotmail.com',
            'password' => bcrypt('password'),
            'role_id' => 2
        ]);
    }
}
