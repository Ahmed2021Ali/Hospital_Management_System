<?php

namespace App\Livewire\GroupServices;

use App\Livewire\Forms\GroupServiceForm;
use App\Models\Group\Group;
use App\Models\Service\Service;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Form;

class CreateGroupServices extends Component
{
    public $groupServices = [];
    public $allServices;
    public $discount_value = 0;
    public $taxes = 17;
    public $totalPriceBeforDiscount;
    public $totalPriceAfterDiscount;
    public $totalPriceAfterTax;

    public GroupServiceForm $form;


    public function mount()
    {
        $Service=new Service();
        $this->allServices=$Service->getAllService();
    }
    public function addService(){
        if($this->checkError('يجب حفظ هذا الخدمة قبل إنشاء خدمة جديدة.')) {
            return redirect()->back();
        }
        $this->groupServices[] = [
            'service_id' => '',
            'quantity' => 1,
            'is_saved' => false,
            'service_name' => '',
            'service_price' => 0
        ];
    }
    public function editService($key){
        if($this->checkError('يجب حفظ هذا الخدمة قبل إنشاء خدمة جديدة.')) {
            return redirect()->back();
        }
        $this->groupServices[$key]['is_saved'] = false;
    }
    public function saveService($key){
        if($this->groupServices[$key]['service_id']) {
            $this->groupServices[$key]['is_saved'] = true;
            $this->servicePrice();
        }
        else {
          return $this->addError('groupServices.' . $key, 'يجب احتيار الخدمة اولا ');
        }
    }
   public function removeService($key)
    {
        unset($this->groupServices[$key]);
        $this->servicePrice();
        $this->groupServices = array_values($this->groupServices);
        return redirect()->back();
    }
    public function saveGroup()
    {
        if($this->checkError('يجب حفظ هذا الخدمة قبل إنشاء خدمة جديدة.')) {
            return redirect()->back();
        }
        $this->form->saveGroup($this->totalPriceBeforDiscount,$this->form->discount_value,$this->totalPriceAfterDiscount,$this->form->taxes,$this->totalPriceAfterTax,$this->groupServices);

    }
    
    public function clickService($key)
    {
        if($this->groupServices[$key]['service_id'])
        {
            $service= Service::where('id', $this->groupServices[$key]['service_id'])->first();
            $this->groupServices[$key]['service_name'] =$service->name;
            $this->groupServices[$key]['service_price'] =$service->price * $this->groupServices[$key]['quantity'] ;
        }
    }

    public function render()
    {
        return view('livewire.group-services.create-group-services');
    }
    public function servicePrice()
    {
        $this->totalPriceBeforDiscount=0;
        $this->totalPriceAfterDiscount=0;
        $this->totalPriceAfterTax=0;
        foreach($this->groupServices as $service) {
            if($service['is_saved'] == true) {
                $this->totalPriceBeforDiscount += $service['service_price'] * $service['quantity'];
            }
        }
        if($this->form->discount_value) {
            $this->totalPriceAfterDiscount = $this->totalPriceBeforDiscount - ($this->totalPriceBeforDiscount  *  $this->form->discount_value/100) ;
            if($this->taxes) {
                $this->totalPriceAfterTax = $this->totalPriceAfterDiscount  *   $this->taxes /100 + $this->totalPriceAfterDiscount;
            }
        } else{
            if($this->taxes) {
                $this->totalPriceAfterTax = $this->totalPriceBeforDiscount  *   $this->taxes /100 + $this->totalPriceBeforDiscount;
            }
        }
    }
    public function checkError($message)
    {
        if(isset($this->groupServices)) {
            foreach($this->groupServices as $key => $service) {
                if ($service['is_saved'] == false) {
                    return $this->addError('groupServices.' . $key, $message);
                }
            }
        }
    }
}
