<?php

namespace App\Interfaces\Doctors;

interface DoctorRepositoryInterface
{
    // get  all Doctor
    public function index();
    // create Doctor
    public function create();

    // store Doctor
    public function store($request);
    // edit Doctor
    public function edit($id);
    // update Doctor
    public function update($request ,$id);
    // destroy Doctor
    public function destroy($id);
    // selected Doctor

}
