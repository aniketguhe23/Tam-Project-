<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MassDestroyCounselorAssignmentRequest;
use App\Http\Requests\StoreCounselorAssignmentRequest;
use App\Http\Requests\UpdateCounselorAssignmentRequest;
use App\Models\CounselorAssignment;
use App\Models\Category;
use App\Models\User;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CounselorAssignmentController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('counselorassignment_accsess'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {

            $query = CounselorAssignment::with(['getCounselor','getUser','getCategory'])->get();
           // dd($query);
            $query = CounselorAssignment::with(['getCounselor','getUser','getCategory'])->select(sprintf('%s.*', (new CounselorAssignment)->table));
            $table = Datatables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'counselorassignment_show';
                $editGate      = 'counselorassignment_edit';
                $deleteGate    = 'counselorassignment_delete';
                $crudRoutePart = 'counselorassignments';

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

            $table->editColumn('counselor_id', function ($row) {
                return $row->counselor_id ? $row->getCounselor->name : "";
            });

            $table->editColumn('category_id', function ($row) {
                return $row->category_id ? $row->getCategory->category_name : "";
            });

            $table->editColumn('user_id', function ($row) {
                return $row->getUser->id ? $row->getUser->name : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.counselorassignments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('counselorassignment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $counselors = User::with(['roles'])->where('status',2)->get();
        $users = User::with(['roles'])->get();
        $categorys = Category::get();
        return view('admin.counselorassignments.create',compact('users','categorys','counselors'));
    }

    public function store(StoreCounselorAssignmentRequest $request)
    {
        //dd($request->all());
        $counselorassignment = CounselorAssignment::create($request->all());

        return redirect()->route('admin.counselorassignments.index');
    }

    public function edit(CounselorAssignment $counselorassignment)
    {
        abort_if(Gate::denies('counselorassignment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.counselorassignments.edit', compact('category'));
    }

    public function update(UpdateCounselorAssignmentRequest $request, CounselorAssignment $counselorassignment)
    {
        $counselorassignment->update($request->all());

        return redirect()->route('admin.counselorassignments.index');
    }

    public function show(CounselorAssignment $counselorassignment)
    {
        abort_if(Gate::denies('counselorassignment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.counselorassignments.show', compact('counselorassignment'));
    }

    public function destroy(CounselorAssignment $counselorassignment)
    {
        abort_if(Gate::denies('counselorassignment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $counselorassignment->delete();

        return back();
    }

    public function massDestroy(MassDestroyCounselorAssignmentRequest $request)
    {
        CounselorAssignment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
