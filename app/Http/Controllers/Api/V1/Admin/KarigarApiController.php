<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKarigarRequest;
use App\Http\Requests\UpdateKarigarRequest;
use App\Http\Resources\Admin\KarigarResource;
use App\Models\Karigar;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KarigarApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('karigar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KarigarResource(Karigar::all());
    }

    public function store(StoreKarigarRequest $request)
    {
        $karigar = Karigar::create($request->all());

        return (new KarigarResource($karigar))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Karigar $karigar)
    {
        abort_if(Gate::denies('karigar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KarigarResource($karigar);
    }

    public function update(UpdateKarigarRequest $request, Karigar $karigar)
    {
        $karigar->update($request->all());

        return (new KarigarResource($karigar))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Karigar $karigar)
    {
        abort_if(Gate::denies('karigar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $karigar->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
