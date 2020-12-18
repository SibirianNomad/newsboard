<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        factory(\App\Models\User::class,1)->create();
        factory(\App\Models\Announcement::class,15)->create();

    }
}
