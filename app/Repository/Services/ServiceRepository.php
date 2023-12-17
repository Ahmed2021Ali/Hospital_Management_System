<?php

namespace App\Repository\Services;

use App\Interfaces\Services\ServiceRepositoryInterface;
use App\Models\Service\Service;

class ServiceRepository implements ServiceRepositoryInterface
{
    public $services;

    public function __construct()
    {
        $this->services = new Service();
    }

    public function index()
    {
        return view('Dashboard.Services.Single_Service.index',[
            'services' => $this->services->getAllService(),
            ]);
    }

    public function store($request)
    {
        Service::create([...$request]);
        session()->flash('add');
        return to_route('service.index');
    }

    public function update($request,$service)
    {
        $service->update([...$request]);
        session()->flash('edit');
        return to_route('service.index');
    }

    public function destroy($service)
    {
        $service->delete();
        session()->flash('delete');
        return to_route('service.index');
    }

    public function show()
    {
        // TODO: Implement show() method.
    }
}
