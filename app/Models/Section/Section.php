<?php

namespace App\Models\Section;

use App\Models\Doctor\Doctor;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Section extends Model
{
    use HasFactory,Translatable;

    protected $fillable = ['name','description'];
    public $translatedAttributes = ['name','description'];

    public function doctor()
    {
        return $this->hasMany(Doctor::class);
    }
}
