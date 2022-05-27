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
        // dd("bhupendra");
        // $users = User::with(['roles'])->where('status',2)->get();
        // $categorys = Category::get();
        return view('admin.bookappointments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bookappointment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.bookappointments.create');
    }

    public function edit(TamHub $tamhub)
    {
        // abort_if(Gate::denies('bookappointment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $categorys = Category::get();
        // return view('admin..edit', compact('counselor','categorys'));
    }

    public function update(UpdateBookAppointmentRequest $request, TamHub $tamhub)
    {
        return redirect()->route('admin..index');
    }

    public function show(TamHub $tamhub)
    {
        abort_if(Gate::denies('bookappointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $counselor->load('roles');

        return view('admin..show', compact('counselor'));
    }

    public function destroy(TamHub $tamhub)
    {
        abort_if(Gate::denies('bookappointment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tamhub->delete();

        return back();
    }

    public function massDestroy(MassDestroyBookAppointmentRequest $request)
    {
        Tamhub::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
