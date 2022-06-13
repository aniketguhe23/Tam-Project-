<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ResourceCategory;
use App\Http\Requests\MassDestroyResourceCategoryRequest;
use App\Http\Requests\StoreResourceCategoryRequest;
use App\Http\Requests\UpdateResourceCategoryRequest;
use Gate;
use Session;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ResourceCategoryController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('resource_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $resourcecategorys = ResourceCategory::get();
        return view('admin.resourcecategorys.index',compact('resourcecategorys'));
    }

    public function create()
    {
        abort_if(Gate::denies('resource_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.resourcecategorys.create');
    }

    public function store(StoreResourceCategoryRequest $request)
    {
        $resourcecategorys = ResourceCategory::create($request->all());
        Session::flash('message', 'Resource Category Add Succsesfully...!'); 
        return redirect()->route('admin.resourcecategorys.index');
    }

    public function edit(Category $category)
    {
        abort_if(Gate::denies('resource_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.resourcecategory.edit', compact('category'));
    }

    public function update(UpdateResourceCategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        Session::flash('message', 'Category Updated Succsesfully...!'); 
        return redirect()->route('admin.resourcecategorys.index');
    }

    public function show(Category $category)
    {
        abort_if(Gate::denies('category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.resourcecategory.show', compact('category'));
    }

    public function destroy(Category $category)
    {
        abort_if(Gate::denies('category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $category->delete();

        return back();
    }

    public function massDestroy(MassDestroyResourceCategoryRequest $request)
    {
        ResourceCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
