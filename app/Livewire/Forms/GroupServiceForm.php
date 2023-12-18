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

    #[Validate('nullable|numeric|min:0|max:99')]
    public $discount_value = 0;

    #[Validate('nullable|numeric|min:0|max:99')]
    public $taxes = 0;
    #[Validate('required')]
    public $groupServices = array();


    public function saveGroup($totalPriceBeforeDiscount, $totalPriceAfterDiscount, $totalPriceAfterTax)
    {
        $this->validate();
        $Groups = new Group();
        $Groups->Total_before_discount = $totalPriceBeforeDiscount;
        $Groups->discount_value = $this->discount_value;
        $Groups->Total_after_discount = $totalPriceAfterDiscount;
        $Groups->tax_rate = $this->taxes;
        $Groups->Total_with_tax = $totalPriceAfterTax;
        $Groups->name = $this->name_group;
        $Groups->notes = $this->notes;
        $Groups->save();
        foreach ($this->groupServices as $service) {
            $Groups->services()->attach($service['service_id'], ['quantity' => $service['quantity']]);
        }
        $this->reset('groupServices', 'name_group', 'notes');
        $this->discount_value = 0;
    }


    public function updateGroup($totalPriceBeforeDiscount, $totalPriceAfterDiscount, $totalPriceAfterTax, Group $group)
    {
        $group->update([
            'Total_before_discount' => $totalPriceBeforeDiscount,
            'discount_value' => $this->discount_value,
            'Total_after_discount' => $totalPriceAfterDiscount,
            'tax_rate' => $this->taxes,
            'Total_with_tax' => $totalPriceAfterTax,
            'name' => $this->name_group,
            'notes' => $this->notes,
        ]);
        $group->services()->detach();
        foreach ($this->groupServices as $service) {
            $group->services()->attach($service['service_id'], ['quantity' => $service['quantity']]);
        }
    }

}
