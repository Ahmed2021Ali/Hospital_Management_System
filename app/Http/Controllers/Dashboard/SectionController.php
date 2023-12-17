<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Sections\StoreSectionRequest;
use App\Http\Requests\Sections\UpdateSectionRequest;
use App\Models\Section\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Sections\SectionRepositoryInterface;

class SectionController extends Controller
{
     private $Section;
    public function __construct(SectionRepositoryInterface $Section)
    {
        $this->Section = $Section;
    }

    public function index()
    {
        return  $this->Section->index();
    }

    public function store(StoreSectionRequest $request)
    {
        return  $this->Section->store($request->validated());
    }

    public function update(UpdateSectionRequest $request,Section $Section)
    {
        return $this->Section->update($request->validated(),$Section);
    }

    public function destroy(Section $Section)
    {
        return  $this->Section->destroy($Section);
    }

    public function show(Section $Section)
    {
        return  $this->Section->show($Section);
    }


}
