<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKarigarOrderRequest;
use App\Http\Requests\UpdateKarigarOrderRequest;
use App\Http\Resources\Admin\KarigarOrderResource;
use App\Models\KarigarOrder;
use App\Models\Karigar;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KarigarOrdersApiController extends Controller
{
    public function index()
    {
        //abort_if(Gate::denies('karigar_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KarigarOrderResource(KarigarOrder::with(['karigar', 'product_design'])->get());
    }

    

    public function store(StoreKarigarOrderRequest $request)
    {
        $karigarOrder = KarigarOrder::create($request->all());

        return (new KarigarOrderResource($karigarOrder))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(KarigarOrder $karigarOrder)
    {
        abort_if(Gate::denies('karigar_order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KarigarOrderResource($karigarOrder->load(['karigar', 'product_design']));
    }

    public function update(UpdateKarigarOrderRequest $request, KarigarOrder $karigarOrder)
    {
        $karigarOrder->update($request->all());

        return (new KarigarOrderResource($karigarOrder))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(KarigarOrder $karigarOrder)
    {
        abort_if(Gate::denies('karigar_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $karigarOrder->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function order_single(Request $request)
    {
        $order = KarigarOrder::where('karigar_id',$request->karigar_id)->get();
        return response()->json(['status'=>'success','order'=>$order],200);
    }

    public function karigor_login(Request $request)
    {
        $karigor = Karigar::where('mobile_no',$request->mobile)->first();
       
        if(empty($karigor))
        {
            return response()->json(['status'=>'error','message'=>'Customer not exist'],401);
        }
        if(!Hash::check( $request->password,$karigor->password))
        {
            return response()->json(['status'=>'error','message'=>'Password not match'],401);
        }
        else
        {
            return response(['status'=>'success','message'=>'success','data'=>$karigor],200);
        }
    }

    public function karigor_signup(Request $request)
    {
        if(empty(Karigar::where('mobile_no',$request->mobile_no)->first()))
        {
            $karigar = new Karigar;
            $karigar->name = $request->name;
            $karigar->mobile_no = $request->mobile_no;
            $karigar->alternate_mobile_no  = $request->alternate_mobile_no;
            $karigar->email = $request->email;
            $karigar->password = Hash::make($request->password);
            $karigar->address = $request->address;
            $karigar->district = $request->district;
            $karigar->city = $request->city;
            $karigar->date_of_birth = $request->date_of_birth; 
            $karigar->date_of_anniversary = $request->date_of_anniversary;
            $karigar->save();
            return response()->json(['status'=>'success','message'=>'Karigar registered successfully'],200);
        }
        else
        {
            return response()->json(['status'=>'error','message'=>'Karigar already exist'],401);
        }
    }
}
