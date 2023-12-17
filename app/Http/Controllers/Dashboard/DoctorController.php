<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Doctor\StoreDoctorRequest;
use App\Http\Requests\Doctor\UpdateDoctorRequest;
use App\Http\Requests\Doctor\UpdatePassswordDoctorRequest;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Models\Doctor\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    private $Doctor;
    public function __construct(DoctorRepositoryInterface $Doctor)
    {
        $this->Doctor = $Doctor;
    }

    public function index()
    {
        return $this->Doctor->index();
    }

    public function create()
    {
        return $this->Doctor->create();
    }

    public function store(StoreDoctorRequest $request)
    {
       return $this->Doctor->store($request->validated());
    }

    public function edit(Doctor $Doctor)
    {
        return $this->Doctor->edit($Doctor);
    }

    public function update(UpdateDoctorRequest $request,Doctor $Doctor)
    {
        return $this->Doctor->update($request->validated(),$Doctor);
    }

    public function destroy(Doctor $Doctor)
    {
        return  $this->Doctor->destroy($Doctor);
    }

    public function deleteSelected(Request $request)
    {
        return  $this->Doctor->deleteSelected($request['delete_select_id']);
    }
    public function passwordUpdate(UpdatePassswordDoctorRequest $request,Doctor $Doctor)
    {
        return  $this->Doctor->passwordUpdate($request->validated(),$Doctor);
    }
    public function statusUpdate(Request$request,Doctor $Doctor)
    {
        return  $this->Doctor->statusUpdate($request['status'],$Doctor);
    }

    /*
public function show($id)
{
    return  $this->Doctor->show($id);
} */
}
