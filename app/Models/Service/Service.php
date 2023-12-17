<?php

namespace App\Models\Service;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory,Translatable;

    protected $fillable = ['price','description','status','name'];
    public $translatedAttributes = ['description','name'];

    public function getAllService()
    {
        return Service::all();
    }
}
