<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Library;
use App\Models\LibraryCategory;
use App\Http\Requests\MassDestroyLibraryRequest;
use App\Http\Requests\UpdateLibraryRequest;
use Gate;
use Session;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LibraryController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('library_accses'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $librarys = Library::with('LibraryCategory')->get();
        $librarycategorys = LibraryCategory::get();
        return view('admin.librarys.index',compact('librarys','librarycategorys'));
    }

    public function create()
    {
        abort_if(Gate::denies('library_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $librarycategorys = LibraryCategory::get();
        return view('admin.librarys.create',compact('librarycategorys'));
    }

    public function store(Request $request)
    {
        $librarys = Library::create($request->all());
        Session::flash('message', 'Library Add Succsesfully...!'); 
        return redirect()->route('admin.librarys.index');
    }

    public function edit(Library $library)
    {
        abort_if(Gate::denies('library_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $librarycategorys = LibraryCategory::get();
        return view('admin.librarys.edit', compact('library','librarycategorys'));
    }

    public function update(Request $request, Library $library)
    {
        $library->update($request->all());
        Session::flash('message', 'Library Category Updated Succsesfully...!'); 
        return redirect()->route('admin.librarys.index');
    }

    public function show(Library $library)
    {
        abort_if(Gate::denies('library_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $librarycategorys = LibraryCategory::get();
        return view('admin.librarys.show', compact('library','librarycategorys'));
    }

    public function destroy(Library $library)
    {
        abort_if(Gate::denies('library_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $library->delete();

        return back();
    }

    public function massDestroy(MassDestroyLibraryRequest $request)
    {
        Library::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
