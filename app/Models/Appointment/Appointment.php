<?php

namespace App\Models\Appointment;

use App\Models\Doctor\Doctor;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory,Translatable;

    protected $fillable = ['name',];
    public $translatedAttributes = ['name'];

    public function getAllAppointments()
    {
        return Appointment::all();
    }
   public function doctors()
    {
        return $this->belongsToMany(Doctor::class,'pivot_appointment_doctors','appointment_id','doctor_id');
    }
}
