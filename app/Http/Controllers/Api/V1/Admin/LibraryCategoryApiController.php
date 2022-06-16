<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLibraryCategoryRequest;
use App\Http\Requests\UpdateLibraryCategoryRequest;
use App\Http\Resources\Admin\TamhubLibraryCategoryResource;
use App\Models\LibraryCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LibraryCategoryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('library_category_accses'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new TamhubLibraryCategoryResource(LibraryCategory::get());
    }

    public function store(StoreLibraryCategoryCategoryRequest $request)
    {
        $LibraryCategorys = LibraryCategory::create($request->all());
        return (new TamhubLibraryCategoryResource($LibraryCategorys))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpdateLibraryCategoryCategoryRequest $request, LibraryCategory $librarycategory)
    {
        $librarycategory->update($request->all());
        return (new TamhubLibraryCategoryResource($librarycategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(LibraryCategory $librarycategory)
    {
        abort_if(Gate::denies('library_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $librarycategory->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
