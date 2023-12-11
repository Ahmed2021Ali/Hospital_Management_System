<?php

namespace Database\Seeders;

use App\Models\Section\Section;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SectionSeeder extends Seeder
{

    public function run(): void
    {
        Section::factory(5)->create();
    }

}
