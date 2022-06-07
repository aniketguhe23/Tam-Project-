<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MassDestroyCurrentCasesRequest;
use App\Http\Requests\StoreCurrentCasesRequest;
use App\Http\Requests\UpdateCurrentCasesRequest;
use App\Models\CounselorCurrentCases;
use App\Models\User;
use App\Models\Category;
use Gate;
use Auth;
use Symfony\Component\HttpFoundation\Response;

class CounselorCurrentCasesController extends Controller
{
    
        public function index()
        {
            abort_if(Gate::denies('counselor_current_cases_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $counselorcurrentcases = CounselorCurrentCases::get();
            return view('admin.counselorcurrentcases.index', compact('counselorcurrentcases'));
        }
    
        public function create()
        {
            abort_if(Gate::denies('counselor_current_cases_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $categorys = Category::get();
            $categorys = User::where('status',0)->get();
            return view('admin.counselorcurrentcases.create', compact('roles','categorys'));
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
            $user = CounselorCurrentCases::create($counselorArr);
            $user->roles()->sync($request->input('roles', []));
    
            return redirect()->route('admin.counselorcurrentcases.index');
        }
    
        public function edit(User $counselor)
        {
            abort_if(Gate::denies('counselor_current_cases_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $categorys = Category::get();
            return view('admin.counselorcurrentcases.edit', compact('counselor','categorys'));
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
            return redirect()->route('admin.counselorcurrentcases.index');
        }
    
        public function show(User $counselor)
        {
            abort_if(Gate::denies('counselor_current_cases_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    
            $counselor->load('roles');
    
            return view('admin.counselorcurrentcases.show', compact('counselor'));
        }
    
        public function destroy(User $counselor)
        {
            abort_if(Gate::denies('counselor_current_cases_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    
            $counselor->delete();
    
            return back();
        }
    
        public function massDestroy(MassDestroyCounselorRequest $request)
        {
            CounselorCurrentCases::whereIn('id', request('ids'))->delete();
    
            return response(null, Response::HTTP_NO_CONTENT);
        }
    
    
}
