<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTamhubRequest;
use App\Http\Requests\UpdateTamhubRequest;
use App\Http\Resources\Admin\TamhubResource;
use App\Models\Tamhub;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TamhubApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tamhub_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TamhubResource(Tamhub::get());
    }

    public function store(StoreTamhubRequest $request)
    {
        $Tamhubs = Tamhub::create($request->all());
        return (new TamhubResource($Tamhubs))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpdateTamhubRequest $request, Tamhub $tamhub)
    {
        $tamhub->update($request->all());
        return (new TamhubResource($tamhub))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Tamhub $tamhub)
    {
        abort_if(Gate::denies('tamhub_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tamhub->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
