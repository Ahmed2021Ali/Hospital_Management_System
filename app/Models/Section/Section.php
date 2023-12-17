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

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
    public function getAllSections()
    {
        return Section::all();
    }
    public function getDoctors($id)
    {
        return Section::findOrFail($id)->doctors;
    }




}
