<?php

namespace App\Interfaces\Doctors;

interface DoctorRepositoryInterface
{
    public function index();
    public function create();
    public function store($request);
    public function edit($Doctor);
    public function update($request ,$Doctor);
    public function destroy($Doctor);
    public function deleteSelected($request);

    public function passwordUpdate($request,$Doctor);

    public function statusUpdate($request,$Doctor);




}
