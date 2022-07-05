<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MassDestroyCounselorAssignmentRequest;
use App\Http\Requests\StoreCounselorAssignmentRequest;
use App\Http\Requests\UpdateCounselorAssignmentRequest;
use App\Models\CounselorAssignment;
use App\Models\WaitingAssignments;
use App\Models\Category;
use App\Models\User;
use Gate;
use Auth;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CounselorAssignmentController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('counselorassignment_accsess'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $sessionCounselorid = Auth::user()->id;
        if($sessionCounselorid == 1){
            $waitingUsers = WaitingAssignments::with('getUser','getCategory')->get();

            $counselorassignment = CounselorAssignment::with('getUser','getCategory')->get();

            $counselorassignments = User::where('status','2')
                                        ->where('counselor_availability','1')
                                        ->get();
        
        }else{
            $users = User::with(['roles'])->where('id',$sessionCounselorid)->where('status','2')->get();
            $counselorassignments = User::with(['roles'])->where('id',$sessionCounselorid)->where('status','2')->get();
        }
        $categorys = Category::get();
        return view('admin.counselorassignments.index', compact('waitingUsers','categorys','counselorassignments','sessionCounselorid'));
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


    public function counselorAssignUser(Request $request)
    {
        echo $counselorid = $request->input('thisCouslorId');  
        die();
        $counselorid = $counselorId;
        $userid = $userId;
        $counselorAssign = array();
        $counselorAssign['counselor_id'] = $counselorid;
        $counselorAssign['user_id'] = $userid;
        $counselorAssign['category_id'] = 1;
        $counselorAssign['chat_type'] = "live";
        $counselorAssign['availability'] = 1;
        $counselorAssign = CounselorAssignment::create($counselorAssign);
        return response($counselorAssign, Response::HTTP_NO_CONTENT);
    }
}
