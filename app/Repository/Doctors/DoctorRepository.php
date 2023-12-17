<?php

namespace App\Repository\Doctors;

use App\Models\Doctor\Doctor;
use App\Models\Section\Section;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Appointment\Appointment;
use App\Interfaces\Doctors\DoctorRepositoryInterface;


class DoctorRepository implements DoctorRepositoryInterface
{
    public $sections;
    public $appointments;
    public $doctors;

    public function __construct()
    {
        $this->sections = new Section();
        $this->appointments = new Appointment();
        $this->doctors = new Doctor();
    }

    public function index()
    {
      return view('Dashboard.Doctors.index', ['doctors' => $this->doctors->getAllDoctors()]);
    }

    public function create()
    {
        return view('Dashboard.Doctors.add', [
            'sections' => $this->sections->getAllSections(),
            'appointments' => $this->appointments->getAllAppointments(),
        ]);
    }

    public function store($request)
    {
        $doctor=  Doctor::create([
            'name'=>$request['name'],
            'email'=>$request['email'],
            'phone'=>$request['phone'],
            'section_id'=>$request['section_id'],
            'password' => Hash::make($request['password']),
            'image' => isset($request['image']) ? uploadImage($request['image'], 'doctors') : null,
        ]);
        $doctor->doctorAppointments()->attach($request['appointments']);
        session()->flash('add');
        return to_route('Doctor.create');
    }

    public function edit($Doctor)
    {
        return view('Dashboard.Doctors.edit', [
            'Doctor' => $Doctor,
            'sections' => $this->sections->getAllSections(),
            'appointments' => $this->appointments->getAllAppointments(),
        ]);
    }

    public function update($request, $Doctor)
    {
        if (isset($request['image']) && $Doctor['image']) {
            deleteImage($Doctor['image'], 'doctors');
        }
        $Doctor->update([
            'name'=>$request['name'],
            'email'=>$request['email'],
            'phone'=>$request['phone'],
            'section_id'=>$request['section_id'],
            'image' => isset($request['image']) ? uploadImage($request['image'],'doctors') : $Doctor->image,
        ]);
        $Doctor->doctorAppointments()->sync($request['appointments']);
        session()->flash('update');
        return to_route('Doctor.index');
    }

    public function destroy($Doctor)
    {
        if ($Doctor['image']) {
            deleteImage($Doctor['image'], 'doctors');
        }
        $Doctor->delete();
        session()->flash('delete');
        return redirect()->back();
    }

    public function deleteSelected($request)
    {
        if ($request) {
            foreach (explode(",", $request) as $doctor_id) {
                $Doctor = Doctor::where('id', $doctor_id)->first();
                if ($Doctor['image']) {
                    deleteImage($Doctor['image'], 'doctors');
                }
                $Doctor->delete();
            }
        }
        session()->flash('delete');
        return to_route('Doctor.index');
    }

    public function passwordUpdate($request,$Doctor)
    {
        $Doctor->password = Hash::make($request['password']);
        $Doctor->save();
        session()->flash('edit');
        return redirect()->back();
    }

    public function statusUpdate($request,$Doctor)
    {
        if($request == 0) {
            $Doctor->status=0;
        }else{
            $Doctor->status=1;
        }
        $Doctor->save();
        session()->flash('edit');
        return redirect()->back();
    }


}
