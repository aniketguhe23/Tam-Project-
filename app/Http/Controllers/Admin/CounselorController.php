<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCounselorRequest;
use App\Http\Requests\StoreCounselorRequest;
use App\Http\Requests\UpdateCounselorRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\Category;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CounselorController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('counselor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::with(['roles'])->where('status',2)->get();
        return view('admin.counselors.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('counselor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');
        $categorys = Category::get();

        return view('admin.counselors.create', compact('roles','categorys'));
    }

    public function store(StoreCounselorRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.counselors.index');
    }

    public function edit(Counselor $counselor)
    {
        abort_if(Gate::denies('counselor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');

        $user->load('roles');

        return view('admin.counselors.edit', compact('roles', 'user'));
    }

    public function update(UpdateCounselorRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.counselors.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('counselor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles');

        return view('admin.counselors.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('counselor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyCounselorRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
