<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLibraryRequest;
use App\Http\Requests\UpdateLibraryRequest;
use App\Http\Resources\Admin\TamhubLibraryResource;
use App\Models\Library;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LibraryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('library_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new TamhubLibraryResource(Library::get());
    }

    public function store(StoreLibraryRequest $request)
    {
        $Librarys = Library::create($request->all());
        return (new TamhubLibraryResource($Librarys))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpdateLibraryRequest $request, Library $library)
    {
        $library->update($request->all());
        return (new TamhubLibraryResource($library))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Library $library)
    {
        abort_if(Gate::denies('library_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $library->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
