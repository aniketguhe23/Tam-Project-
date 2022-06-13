<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Library;
use App\Http\Requests\MassDestroyLibraryRequest;
use App\Http\Requests\StoreLibraryRequest;
use App\Http\Requests\UpdateLibraryRequest;
use Gate;
use Session;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LibraryController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('library_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $librarys = Library::get();
        return view('admin.librarys.index',compact('librarys'));
    }

    public function create()
    {
        abort_if(Gate::denies('library_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.librarys.create');
    }

    public function store(StoreLibraryRequest $request)
    {
        $librarys = Library::create($request->all());
        Session::flash('message', 'Library Add Succsesfully...!'); 
        return redirect()->route('admin.librarys.index');
    }

    public function edit(Library $library)
    {
        abort_if(Gate::denies('library_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.library.edit', compact('library'));
    }

    public function update(UpdateLibraryRequest $request, Library $library)
    {
        $library->update($request->all());
        Session::flash('message', 'Library Category Updated Succsesfully...!'); 
        return redirect()->route('admin.librarys.index');
    }

    public function show(Library $library)
    {
        abort_if(Gate::denies('library_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.library.show', compact('library'));
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
