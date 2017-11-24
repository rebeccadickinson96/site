<?php

use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'display_name' => $faker->word,
        'description' => $faker->paragraph
    ];
});

$factory->define(App\Permission::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'display_name' => $faker->word,
    ];
});

$factory->define(App\Permission::class, function (Faker\Generator $faker) {
    return [
        'role_id' => function () {
            return factory(App\Role::class)->create()->id;
        },
        'permission_id' => function () {
            return factory(App\Permission::class)->create()->id;
        }
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'role_id' => 2
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->word,
        'body' => $faker->paragraph,
        'user_id' => 1,
        'date_published' => Carbon::now(),
        'published' => 1
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'category' => $faker->word,
        'description' => $faker->sentence
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'post_id' => function () {
            return factory(App\Post::class)->create()->id;
        },
        'body' => $faker->paragraph,
        'user_id' => null,
        'commenter_name' => 'Rebecca Dickinson'
    ];
});

$factory->define(App\CategoryPost::class, function (Faker\Generator $faker) {
    return [
        'post_id' => function () {
            return factory(App\Post::class)->create()->id;
        },
        'category_id' => function () {
            return factory(App\Category::class)->create()->id;
        }
    ];
});
