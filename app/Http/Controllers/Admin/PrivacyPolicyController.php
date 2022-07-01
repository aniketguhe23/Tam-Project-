<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MassDestroyPrivacyPolicyRequest;
use App\Http\Requests\StorePrivacyPolicyRequest;
use App\Http\Requests\UpdatePrivacyPolicyRequest;
use App\Models\PrivacyPolicy;
use Gate;
use Session;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('privacy_policy_accses'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $privacypolicys = PrivacyPolicy::get();
        return view('admin.privacypolicys.index',compact('privacypolicys'));
    }

    public function create()
    {
        abort_if(Gate::denies('privacy_policy_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.privacypolicys.create');
    }

    public function store(StorePrivacyPolicyRequest $request)
    {
        $privacyPolicys = PrivacyPolicy::create($request->all());
        Session::flash('message', 'Privacy policy Add Succsesfully...!'); 
        return redirect()->route('admin.privacypolicys.index');
    }

    public function edit(PrivacyPolicy $privacypolicy)
    {
        abort_if(Gate::denies('privacy_policy_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.privacypolicys.edit', compact('privacypolicy'));
    }

    public function update(UpdatePrivacyPolicyRequest $request, PrivacyPolicy $privacypolicy)
    {
        $privacypolicy->update($request->all());
        Session::flash('message', 'Privcy policy Updated Succsesfully...!'); 
        return redirect()->route('admin.privacypolicys.index');
    }

    public function show(PrivacyPolicy $privacypolicy)
    {
        abort_if(Gate::denies('privacy_policy_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.privacypolicys.show', compact('privacypolicy'));
    }

    public function destroy(PrivacyPolicy $privacypolicy)
    {
        abort_if(Gate::denies('privacy_policy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $privacypolicy->delete();

        return back();
    }

    public function massDestroy(MassDestroyPrivacyPolicyRequest $request)
    {
        PrivacyPolicy::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
