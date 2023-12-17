<?php

namespace App\Models\Group;

use App\Models\Service\Service;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use Translatable;
    use HasFactory;
    public $translatedAttributes = ['name','notes'];
    public $fillable= ['Total_before_discount','discount_value','Total_after_discount','tax_rate','Total_with_tax'];
    //public $guarded=[];

    public function services()
    {
        return $this->belongsToMany(Service::class,'pivot_group_service','group_id','service_id');
    }
    public function getAllGroupss()
    {
        return Group::all();
    }
}
