<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Announcement;
use Faker\Generator as Faker;

$factory->define(Announcement::class, function (Faker $faker) {
    $cities=['Томск','Москва','Абакан','Абаза'];

    $category_id=rand(1,6);
    $user_id=1;
    $title=$faker->sentence(rand(2,4),true);
    $description=$faker->realText(rand(50,300));
    $city=$cities[rand(0,3)];
    $price= rand(500,4000);
    $status=rand(1, 5) > 1;
    $createAt=$faker->dateTimeBetween('-3 months','-2 days');

    $data=[
        'category_id'   =>$category_id,
        'user_id'       =>$user_id,
        'title'         =>$title,
        'description'   =>$description,
        'city'          =>$city,
        'price'         =>$price,
        'status'        =>$status,
        'created_at'   => $createAt,
        'updated_at'   => $createAt
    ];

    return $data;
});
