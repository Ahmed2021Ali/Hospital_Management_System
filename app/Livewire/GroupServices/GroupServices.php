<?php

namespace App\Livewire\GroupServices;

use App\Livewire\Forms\GroupServiceForm;
use App\Models\Group\Group;
use App\Models\Service\Service;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Form;

class GroupServices extends Component
{

    public $allServices;
    public $totalPriceBeforeDiscount;
    public $totalPriceAfterDiscount;
    public $totalPriceAfterTax;

    public GroupServiceForm $form;
    public $showTable=true;
    public $updateMode=false;
    public $allGroups;
    public  $group;

    public function mount()
    {
        $this->allServices=Service::all();
        $this->allGroups=Group::all();
    }

                /* Groups Methods  */
    public function show_form_add(){
        $this->showTable = false;
    }
    public function saveGroup()
    {
        if($this->checkError('يجب حفظ هذا الخدمة قبل إنشاء خدمة جديدة.')) {
            return redirect()->back();
        }
        if($this->updateMode == true) {
            $this->form->updateGroup($this->totalPriceBeforeDiscount,$this->totalPriceAfterDiscount,$this->totalPriceAfterTax,$this->group);
            session()->flash('message','Update Group Successfully');
            $this->showTable=true;
        }
        else {
            $this->form->saveGroup($this->totalPriceBeforeDiscount,$this->totalPriceAfterDiscount,$this->totalPriceAfterTax);
            session()->flash('message','Add Group Successfully');
        }
        return redirect()->back();
    }
    public function edit_group(Group $group)
    {
        $this->showTable = false;
        $this->updateMode = true;
        $this->group=$group;

        $this->form->name_group=$group->name;
        $this->form->notes=$group->notes;
        $this->form->discount_value=$group->discount_value;
        $this->form->taxes = $group->tax_rate;
        $this->totalPriceBeforeDiscount = $group->Total_before_discount;
        $this->totalPriceAfterDiscount=$group->Total_after_discount;
        $this->totalPriceAfterTax=$group->Total_with_tax;
        foreach($group->services as $groupServices)
        {
            $this->form->groupServices[] = [
                'service_id' => $groupServices->id,
                'quantity' => $groupServices->pivot->quantity,
                'is_saved' => true,
                'service_name' => $groupServices->name,
                'service_price' => $groupServices->price
            ];
        }
    }
    public function delete_group($id){
        Group::destroy($id);
        session()->flash('message','Delete Group Successfully');
        return to_route('GroupService');
    }

                /* End  Methods Group */


                /* Service Methods */
    public function addService(){
        if($this->checkError('يجب حفظ هذا الخدمة قبل إنشاء خدمة جديدة.')) {
            return redirect()->back();
        }
        $this->form->groupServices[] = [
            'service_id' => '',
            'quantity' => 1,
            'is_saved' => false,
            'service_name' => '',
            'service_price' => 0
        ];
    }
    public function saveService($key)
    {
        if($this->form->groupServices[$key]['service_id']) {
            $this->form->groupServices[$key]['is_saved'] = true;
            $this->servicePrice();
        }
        else {
            return $this->checkError('يجب احتيار الخدمة اولا ');
        }
    }
    public function editService($key){
        if($this->checkError('يجب حفظ هذا الخدمة قبل إنشاء خدمة جديدة.')) {
            return redirect()->back();
        }
        $this->form->groupServices[$key]['is_saved'] = false;
    }
   public function removeService($key)
    {
        unset($this->form->groupServices[$key]);
        $this->servicePrice();
        $this->form->groupServices = array_values($this->form->groupServices);
        return redirect()->back();
    }
    public function changeService($key)
    {
        if($this->form->groupServices[$key]['service_id']) {
            $service= Service::where('id', $this->form->groupServices[$key]['service_id'])->first();
            $this->form->groupServices[$key]['service_name'] =$service->name;
            $this->form->groupServices[$key]['service_price'] =$service->price * $this->form->groupServices[$key]['quantity'] ;
        }
    }

                /* End  Methods Service */

    public function servicePrice()
    {
        $this->totalPriceBeforeDiscount=0;
        $this->totalPriceAfterDiscount=0;
        $this->totalPriceAfterTax=0;
        foreach($this->form->groupServices as $service) {
            if($service['is_saved'] == true) {
                $this->totalPriceBeforeDiscount += $service['service_price'] * $service['quantity'];
            }
        }
        if($this->form->discount_value > 0) {
            $this->totalPriceAfterDiscount = $this->totalPriceBeforeDiscount - ($this->totalPriceBeforeDiscount  *  $this->form->discount_value/100) ;
            if($this->form->taxes > 0) {
                $this->totalPriceAfterTax = $this->totalPriceAfterDiscount  *   $this->form->taxes /100 + $this->totalPriceAfterDiscount;
            }
        } else{
            if($this->form->taxes > 0) {
                $this->totalPriceAfterTax = $this->totalPriceBeforeDiscount  *   $this->form->taxes /100 + $this->totalPriceBeforeDiscount;
            }
        }
    }
    public function checkError($message)
    {
        if(isset($this->form->groupServices)) {
            foreach($this->form->groupServices as $key => $service) {
                if ($service['is_saved'] == false) {
                    return $this->addError('form.groupServices.' . $key, $message);
                }
            }
        }
    }


    public function render()
    {
        return view('livewire.group-services.group-services');
    }


}
