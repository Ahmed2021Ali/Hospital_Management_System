<?php

namespace App\Interfaces\Sections;

interface SectionRepositoryInterface
{
          // get All Sections
    public function index();

         // Create Sections
    public function store($request);

        // Update Sections
    public function update($request,$id);

        // Update Sections
    public function destroy($id);

        // get All Sections
    public function show($id);
}
