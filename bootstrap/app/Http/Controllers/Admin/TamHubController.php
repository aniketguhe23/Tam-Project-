<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MassDestroyTamHubRequest;
use App\Http\Requests\StoreTamHubRequest;
use App\Http\Requests\UpdateTamHubRequest;
use App\Models\TamHub;
use Gate;
use Symfony\Component\HttpFoundation\Response;


class TamHubController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tamhub_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $users = User::with(['roles'])->where('status',2)->get();
        // $categorys = Category::get();
        return view('admin.tamhubs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('tamhub_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.tamhubs.create');
    }

    public function store(StoreTamHubRequest $request)
    {
        return redirect()->route('admin.tamhubs.index');
    }

    public function edit(TamHub $tamhub)
    {
        // abort_if(Gate::denies('tamhub_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $categorys = Category::get();
        // return view('admin.tamhubs.edit', compact('counselor','categorys'));
    }

    public function update(UpdateTamHubRequest $request, TamHub $tamhub)
    {
        return redirect()->route('admin.tamhubs.index');
    }

    public function show(TamHub $tamhub)
    {
        abort_if(Gate::denies('tamhub_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $counselor->load('roles');

        return view('admin.tamhubs.show', compact('counselor'));
    }

    public function destroy(TamHub $tamhub)
    {
        abort_if(Gate::denies('tamhub_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tamhub->delete();

        return back();
    }

    public function massDestroy(MassDestroyTamHubRequest $request)
    {
        Tamhub::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

