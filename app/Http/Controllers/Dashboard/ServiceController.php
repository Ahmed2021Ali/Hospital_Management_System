<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\StoreServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;
use App\Interfaces\Services\ServiceRepositoryInterface;
use App\Models\Service\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public $singleServices;
    public function __construct(ServiceRepositoryInterface $singleServices)
    {
        $this->singleServices=$singleServices;
    }

    public function index()
    {
        return $this->singleServices->index();

    }

    public function store(StoreServiceRequest $request)
    {
        return $this->singleServices->store($request->validated());
    }


    public function show(Service $service)
    {
        //
    }
    public function update(UpdateServiceRequest $request, Service $service)
    {
        return $this->singleServices->update($request->validated(),$service);
    }

    public function destroy(Service $service)
    {
        return $this->singleServices->destroy($service);
    }

}
