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
use Yajra\DataTables\Facades\DataTables;


class TamHubController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('tamhub_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = TamHub::query()->select(sprintf('%s.*', (new TamHub)->table));
            $table = Datatables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'tamhub_show';
                $editGate      = 'tamhub_edit';
                $deleteGate    = 'tamhub_delete';
                $crudRoutePart = 'tamhubs';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });

            $table->editColumn('organisation_name', function ($row) {
                return $row->organisation_name ? $row->organisation_name : "";
            });

            $table->editColumn('city', function ($row) {
                return $row->city ? $row->city : "";
            });
            $table->editColumn('areas', function ($row) {
                return $row->areas ? $row->areas : "";
            });
            $table->editColumn('services', function ($row) {
                return $row->services ? $row->services : "";
            });
            $table->editColumn('special_note', function ($row) {
                return $row->special_note ? $row->special_note : "";
            });
            $table->editColumn('contact_no', function ($row) {
                return $row->contact_no ? $row->contact_no : "";
            });
            $table->editColumn('email_id', function ($row) {
                return $row->email_id ? $row->email_id : "";
            });
            $table->editColumn('website_link', function ($row) {
                return $row->website_link ? $row->website_link : "";
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.tamhubs.index');
    }


    public function create()
    {
        abort_if(Gate::denies('tamhub_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.tamhubs.create');
    }

    public function store(StoreTamHubRequest $request)
    {
        $tamhub = TamHub::create($request->all());
        return redirect()->route('admin.tamhubs.index');
    }

    public function edit(TamHub $tamhub)
    {
        abort_if(Gate::denies('tamhub_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.tamhubs.edit', compact('tamhub'));
    }

    public function update(UpdateTamHubRequest $request, TamHub $tamhub)
    {
        $tamhub->update($request->all());
        return redirect()->route('admin.tamhubs.index');
    }

    public function show(TamHub $tamhub)
    {
        abort_if(Gate::denies('tamhub_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.tamhubs.show', compact('tamhub'));
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

