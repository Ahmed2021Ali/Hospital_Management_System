<?php

namespace App\Repository\Sections;

use App\Models\Section\Section;
use App\Interfaces\Sections\SectionRepositoryInterface;

class SectionRepository implements SectionRepositoryInterface
{

    public function index()
    {
      $sections = Section::all();
      return view('Dashboard.Sections.index',compact('sections'));
    }

    public function store($request)
    {
        Section::create([
            'name' => $request->name,
        ]);
        session()->flash('add');
        return redirect()->route('Section.index');
    }

    public function update($request,$id)
    {
        $section = Section::findOrFail($id);
        $section->update([
            'name' => $request->name,
        ]);
        session()->flash('edit');
        return redirect()->route('Section.index');
    }

    public function destroy($id)
    {
        Section::findOrFail($id)->delete();
        session()->flash('delete');
        return redirect()->route('Section.index');
    }
    
    public function show($id)
    {
        $doctors =Section::findOrFail($id)->doctors;
        $section = Section::findOrFail($id);
        return view('Dashboard.Sections.show_doctors',compact('doctors','section'));
    }

}
