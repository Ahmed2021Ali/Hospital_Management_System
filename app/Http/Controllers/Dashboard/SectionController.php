<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Sections\StoreSectionRequest;
use App\Http\Requests\Sections\UpdateSectionRequest;
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
       return  $this->Section->store($request);
    }

    public function update(UpdateSectionRequest $request,$id)
    {
        return  $this->Section->update($request,$id);
    }
    public function destroy($id)
    {
        return  $this->Section->destroy($id);
    }
    public function show($id)
    {
        return  $this->Section->show($id);
    }


}
