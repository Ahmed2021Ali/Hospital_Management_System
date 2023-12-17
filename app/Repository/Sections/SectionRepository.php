<?php

namespace App\Repository\Sections;

use App\Models\Doctor\Doctor;
use App\Models\Section\Section;
use App\Interfaces\Sections\SectionRepositoryInterface;

class SectionRepository implements SectionRepositoryInterface
{
    public $sections;
    public function __construct()
    {
        $this->sections = new Section();
    }

    public function index()
    {
      return view('Dashboard.Sections.index',[
          'sections' => $this->sections->getAllSections(),
      ]);
    }

    public function store($request)
    {
        Section::create([...$request]);
        session()->flash('add');
        return to_route('Section.index');
    }

    public function update($request,$Section)
    {
        $Section->update([...$request]);
        session()->flash('edit');
        return to_route('Section.index');
    }

    public function destroy($Section)
    {
        $Section->delete();
        session()->flash('delete');
        return to_route('Section.index');
    }

    public function show($Section)
    {
        return view('Dashboard.Sections.show_doctors',[
            'doctors' =>$this->sections->getDoctors($Section->id),
            'section' =>$Section
        ]);
    }

}
