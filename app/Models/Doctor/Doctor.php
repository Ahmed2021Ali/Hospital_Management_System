<?php

namespace App\Models\Doctor;

use App\Models\Appointment\Appointment;
use App\Models\Section\Section;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// 1. To specify package’s class you are using
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Doctor extends Model
{
    use Translatable, HasFactory;
    protected $table = 'doctors';
    public $translatedAttributes = ['name','appointments'];
    public $fillable= ['image','section_id','email','email_verified_at','password','phone','price','name'];


    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function getAllDoctors()
    {
        return Doctor::with('doctorAppointments')->get();
    }

    public function doctorAppointments()
    {
        return $this->belongsToMany(Appointment::class,'pivot_appointment_doctors','doctor_id','appointment_id');
    }

}
