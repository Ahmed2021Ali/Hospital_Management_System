<?php

namespace App\Models\Appointment;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory,Translatable;

    protected $fillable = ['name',];
    public $translatedAttributes = ['name'];
}
