<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Project::class, function (Faker $faker) {
    return [
        'title' => $title =  $faker->sentence,
        'slug'  => \Str::slug($title),
        'description' => $faker->paragraph(10),
        'owner_id' => function (){return factory(App\Models\User::class)->create()->id;}
    ];
});
