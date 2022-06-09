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
use Gate;
use Auth;
use Symfony\Component\HttpFoundation\Response;

class CounselorPastCasesController extends Controller
{
    
    public function index()
    {
        abort_if(Gate::denies('counselor_past_cases_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $users = User::with(['roles'])->get();
        // $sessionCounselorid = Auth::user()->id;
        // if($sessionCounselorid == 1){
        //     $users = User::with(['roles'])->where('status','0')->get();
        //     $counselorassignments = User::with(['roles'])->where('status','2')->get();
        // }else{
        //     $users = User::with(['roles'])->where('id',$sessionCounselorid)->where('status','2')->get();
        //     $counselorassignments = User::with(['roles'])->where('id',$sessionCounselorid)->where('status','2')->get();
        // }
        // $categorys = Category::get();
            $counselorpastcases = CounselorPastCases::get();
            $counselors = User::with(['roles'])->where('status','2')->get();
            $categorys = Category::get();
        return view('admin.counselorpastcases.index', compact('counselorpastcases','counselors','categorys'));
    }

    public function create()
    {
        abort_if(Gate::denies('counselor_past_cases_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');
        $categorys = Category::get();
        return view('admin.counselorpastcases.create');
    }

    public function store(StoreCounselorRequest $request)
    {
        //  dd($request->all());
        $counselorArr = array();
        $counselorArr['name'] = $request->name;
        $counselorArr['category_id'] = $request->category_id;
        $counselorArr['email'] = $request->email;
        $counselorArr['phone_no'] = $request->phone_no;
        $counselorArr['password'] = $request->password;
        $counselorArr['status'] = 2;
        $user = CounselorPastCases::create($counselorArr);
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.counselorpastcases.index');
    }

    public function edit(User $counselor)
    {
        abort_if(Gate::denies('counselor_past_cases_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categorys = Category::get();
        return view('admin.counselorpastcases.edit', compact('counselor','categorys'));
    }

    public function update(UpdateCounselorRequest $request, User $counselor)
    {
        $counselorArr = array();
        $counselorArr['name'] = $request->name;
        $counselorArr['category_id'] = $request->category_id;
        $counselorArr['email'] = $request->email;
        $counselorArr['phone_no'] = $request->phone_no;
        $counselorArr['password'] = $request->password;  
        $counselorArr['status'] = 2;
        $counselor->update($counselorArr);
        return redirect()->route('admin.counselorpastcases.index');
    }

    public function show(User $counselor)
    {
        abort_if(Gate::denies('counselor_past_cases_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $counselor->load('roles');

        return view('admin.counselorpastcases.show', compact('counselor'));
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
