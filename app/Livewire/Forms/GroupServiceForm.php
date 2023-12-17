<?php

namespace App\Livewire\Forms;

use App\Models\Group\Group;
use Livewire\Attributes\Validate;
use Livewire\Form;

class GroupServiceForm extends Form
{
    #[Validate('required')]
    public $name_group = '';

    #[Validate('required')]
    public $notes = '';

    #[Validate('nullable|numeric|min:1|max:99')]
    public $discount_value;

    #[Validate('nullable|numeric|min:1|max:99')]
    public $taxes;


    public function saveGroup($taxes,$totalPriceAfterDiscount,$discount_value,$totalPriceAfterTax,$totalPriceBeforDiscount,$groupServices)
    {
        dd("bbbbbbbbb");
        $this->validate();
        $Groups = new Group();
        $Groups->total_befor_discount = $totalPriceBeforDiscount;
        $Groups->discont=$discount_value;
        $Groups->total_after_discount = $totalPriceAfterDiscount;
        $Groups->tax_rate=$taxes;
        $Groups->Total_with_tax = $totalPriceAfterTax;
        $Groups->name=  $this->name_group;
        $Groups->notes= $this->notes;
        $Groups->save();
        foreach($groupServices as $service)
        {
            $service->services()->attach($service['service_id']);
        }
/*        $this->reset('groupServices', 'name_group', 'notes');
        $this->discount_value = 0;
        $this->ServiceSaved = true;*/

    }
}
