<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MassDestroyPastCasesRequest;
use App\Http\Requests\StorePastCasesRequest;
use App\Http\Requests\UpdatePastCasesRequest;
use App\Models\CounselorPastCases;
use App\Models\User;
use App\Models\Category;
use App\Models\AsyncChat;
use App\Models\Feedback;
use App\Models\ChatHistory;
use Gate;
use Auth;
use DB;
use Symfony\Component\HttpFoundation\Response;

class CounselorPastCasesController extends Controller
{
    
    public function index()
    {
        abort_if(Gate::denies('counselor_past_cases_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $sessionCounselorid = Auth::user()->id;
        if($sessionCounselorid == 1)
        {
            $counselorpastcases = CounselorPastCases::with('getUser','getCategory','getFeedback')->get();
            return view('admin.counselorpastcases.index', compact('counselorpastcases'));
        }else{
            $counselorpastcases = CounselorPastCases::with('getUser','getCategory','getFeedback')->where('counselor_id',$sessionCounselorid)->get();
            return view('admin.counselorpastcases.index', compact('counselorpastcases'));
        }
    }

    public function create()
    {
        abort_if(Gate::denies('counselor_past_cases_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roles = Role::all()->pluck('title', 'id');
        $categorys = Category::get();
        return view('admin.counselorpastcases.create');
    }

    
    public function show($userId)
    {
        abort_if(Gate::denies('counselor_past_cases_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $users = User::where('id',$userId)->where('status','0')->first();
        $chatHistorys = ChatHistory::where('counselor_past_cases_id',$userId)->get();
        return view('admin.counselorpastcases.show',compact('chatHistorys','users'));
    }

    public function destroy(User $counselor)
    {
        abort_if(Gate::denies('counselor_past_cases_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $counselor->delete();

        return back();
    }

    public function massDestroy(MassDestroyCounselorRequest $request)
    {
        CounselorPastCases::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
    
    
}
