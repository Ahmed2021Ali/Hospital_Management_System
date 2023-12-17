<?php

namespace App\Interfaces\Sections;

interface SectionRepositoryInterface
{
    public function index();

    public function store($request);

    public function update($request,$Section);

    public function destroy($Section);

    public function show($Section);
}
