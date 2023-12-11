<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\ImageSeeder;
use Database\Seeders\DoctorSeeder;
use Database\Seeders\SectionSeeder;
use Database\Seeders\AppointmentSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            AppointmentSeeder::class,
            SectionSeeder::class,
            DoctorSeeder::class,
           // ImageSeeder::class,

        ]);
    }
}
