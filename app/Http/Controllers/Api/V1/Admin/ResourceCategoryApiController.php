<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResourceCategoryRequest;
use App\Http\Requests\UpdateResourceCategoryRequest;
use App\Http\Resources\Admin\TamhubResourceCategoryResource;
use App\Models\ResourceCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResourceCategoryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tamhub_resource_categorys_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TamhubResourceCategoryResource(ResourceCategory::get());
    }

    public function store(StoreResourceCategoryRequest $request)
    {
        $resourcecategorys = ResourceCategory::create($request->all());
        return (new TamhubResourceCategoryResource($resourcecategorys))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpdateResourceCategoryRequest $request, ResourceCategory $resourcecategory)
    {
        $resourcecategory->update($request->all());
        return (new TamhubResourceCategoryResource($resourcecategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ResourceCategory $resourcecategory)
    {
        abort_if(Gate::denies('tamhub_resource_categorys_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $resourcecategory->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
