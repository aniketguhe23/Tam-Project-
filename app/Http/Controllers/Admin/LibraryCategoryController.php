<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LibraryCategory;
use App\Http\Requests\MassDestroyLibraryCategoryRequest;
use App\Http\Requests\StoreLibraryCategoryRequest;
use App\Http\Requests\UpdateLibraryCategoryRequest;
use Gate;
use Session;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LibraryCategoryController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('library_category_accses'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $librarycategorys = LibraryCategory::get();
        return view('admin.librarycategorys.index',compact('librarycategorys'));
    }

    public function create()
    {
        abort_if(Gate::denies('library_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.librarycategorys.create');
    }

    public function store(Request $request)
    {
        $librarycategorys = LibraryCategory::create($request->all());
        Session::flash('message', 'Resource Category Add Succsesfully...!'); 
        return redirect()->route('admin.librarycategorys.index');
    }

    public function edit(LibraryCategory $librarycategory)
    {
        abort_if(Gate::denies('library_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.librarycategorys.edit', compact('librarycategory'));
    }

    public function update(Request $request, LibraryCategory $librarycategory)
    {
        $librarycategory->update($request->all());
        Session::flash('message', 'Library Category Updated Succsesfully...!'); 
        return redirect()->route('admin.librarycategorys.index');
    }

    public function show(LibraryCategory $librarycategory)
    {
        abort_if(Gate::denies('library_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.librarycategorys.show', compact('librarycategory'));
    }

    public function destroy(LibraryCategory $librarycategory)
    {
        abort_if(Gate::denies('library_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $librarycategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyLibraryCategoryRequest $request)
    {
        LibraryCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
