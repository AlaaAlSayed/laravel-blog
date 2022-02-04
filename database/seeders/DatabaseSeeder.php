<?php

namespace Database\Seeders;

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
        // to run seeder on terminal : 
        // php artisan db:seed 

        \App\Models\User::factory(5)->create();

        \App\Models\Post::factory(5)->create();

        
        // Remove all the records
        // Post::truncate();

        

    }




}  