<?php

namespace Database\Seeders;

use App\Models\Appointment\Appointment;
use App\Models\Doctor\Doctor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors =  Doctor::factory()->count(30)->create();
        $Appointments = Appointment::all();

        foreach ($doctors as $doctor){
           $Appointments = Appointment::all()->random()->id;
            $doctor->doctorAppointments()->attach($Appointments);
        }
/*        Doctor::all()->each(function ($doctor) use ($Appointments) {
            $doctor->appointments()->attach(
                $Appointments->random(rand(1,7))->pluck('id')->toArray()
            );
        });*/
    }
}
