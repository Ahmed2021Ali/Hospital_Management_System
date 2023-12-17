<?php

namespace App\Interfaces\Services;

interface ServiceRepositoryInterface
{
    public function index();

    public function store($request);

    public function update($request,$service);

    public function destroy($service);

    public function show();

}
