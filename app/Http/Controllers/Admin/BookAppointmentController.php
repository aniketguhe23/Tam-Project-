<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MassDestroyBookAppointmentRequest;
use App\Http\Requests\StoreBookAppointmentRequest;
use App\Http\Requests\UpdateBookAppointmentRequest;
use App\Models\BookAppointment;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class BookAppointmentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bookappointment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $bookappointments = BookAppointment::get();
        return view('admin.bookappointments.index',compact('bookappointments'));
    }

    public function create()
    {
        abort_if(Gate::denies('bookappointment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.bookappointments.create');
    }

    
    public function store(StoreBookAppointmentRequest $request)
    {
        $bookappointments = BookAppointment::create($request->all());
        return redirect()->route('admin.bookappointments.index');
    }

    public function edit(BookAppointment $bookappointment)
    {
        abort_if(Gate::denies('bookappointment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.bookappointments.edit', compact('bookappointment'));
    }

    public function update(UpdatebookappointmentRequest $request, bookappointment $bookappointment)
    {
        $bookappointment->update($request->all());

        return redirect()->route('admin.bookappointments.index');
    }

    public function show(BookAppointment $bookappointment)
    {
        abort_if(Gate::denies('bookappointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.bookappointments.show', compact('bookappointment'));
    }

    public function destroy(BookAppointment $bookappointment)
    {
        abort_if(Gate::denies('bookappointment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookappointment->delete();

        return back();
    }

    public function massDestroy(MassDestroybookappointmentRequest $request)
    {
        BookAppointment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
