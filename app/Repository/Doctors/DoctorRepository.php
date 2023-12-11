<?php

namespace App\Repository\Doctors;

use App\Http\traits\media;
use App\Models\Doctor\Doctor;
use App\Models\Section\Section;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Appointment\Appointment;
use App\Interfaces\Doctors\DoctorRepositoryInterface;

class DoctorRepository implements DoctorRepositoryInterface
{
use media;
    public function index()
    {
      $doctors = Doctor::all();
      return view('Dashboard.Doctors.index',compact('doctors'));
    }
    public function create()
    {
        $sections = Section::all();
        $appointments = Appointment::all();
        return view('Dashboard.Doctors.add',compact('sections','appointments'));
    }

    public function store($request)
    {
        $photoName = $this->uploadPhoto($request->photo,'doctors');
        DB::beginTransaction();
        try {

            $doctors = new Doctor();
            $doctors->email = $request->email;
            $doctors->password = Hash::make($request->password);
            $doctors->section_id = $request->section_id;
            $doctors->phone = $request->phone;
            $doctors->price = $request->price;
            $doctors->image = $photoName;
            $doctors->status = 1;
            $doctors->save();
            // store trans
            $doctors->name = $request->name;
            $doctors->appointments =implode(",",$request->appointments);
            $doctors->save();

            DB::commit();
            session()->flash('add');
            return redirect()->route('Doctor.create');

        }
        catch (\Exception $e) {
            DB::rollback();
            $photo_path=public_path('images/doctors/').$photoName;
            $this->deletePhoto($photo_path);
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    public function edit($id)
    {
        $doctor = Doctor::where('id',$id)->first();
        $sections = Section::all();
        return view('Dashboard.Doctors.edit',compact('sections','doctor'));
    }

    public function update($request ,$id)
    {

        $doctor = Doctor::findOrFail($id);
        $appointments =implode(",",$request->appointments);
        if($request->photo)
        {
            $photo_path=public_path('/images/doctors/').$doctor->image;
            $this->deletePhoto($photo_path);
            $photoName = $this->uploadPhoto($request->photo,'doctors');
            $doctor->update([
                ...$request->except('_token','_method','photo','password','appointments'),
                'password'=>Hash::make($request->password),
                'appointments'=> $appointments,
                'image' => $photoName,
            ]);
        }
        else
        {
            $doctor->update([
                ...$request->except('_token','_method','photo','password','appointments'),
                'password'=>Hash::make($request->password),
                'appointments'=> $appointments,
            ]);
        }
        session()->flash('edit');
        return redirect()->route('Doctor.index');
    }

    public function destroy($id)
    {

    $doctor = Doctor::findOrFail($id);
        if($doctor->image){
            $photo_path = public_path('/images/doctors/').$doctor->image;
            $this->deletePhoto($photo_path);
        }
    $doctor->delete();
    session()->flash('delete');
    return redirect()->route('Doctor.index');
    }


}
