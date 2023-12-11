<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\Doctor\Doctor;
use App\Http\Controllers\Controller;
use App\Interfaces\Doctors\DoctorRepositoryInterface;

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
    public function store(Request $request)
    {
       return $this->Doctor->store($request);
    }
    public function edit($id)
    {
        return $this->Doctor->edit($id);
    }

    public function update(Request $request,$id)
    {
        return $this->Doctor->update($request,$id);
    }

    public function destroy($id)
    {
        return  $this->Doctor->destroy($id);
    }
        /*
    public function show($id)
    {
        return  $this->Doctor->show($id);
    } */
}
