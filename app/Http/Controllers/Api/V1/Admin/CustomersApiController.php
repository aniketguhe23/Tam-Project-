<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\Admin\CustomerResource;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomersApiController extends Controller
{
    public function index()
    {
       // abort_if(Gate::denies('customer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CustomerResource(Customer::all());
    }


    public function customer_login(Request $request)
    {
        $customer = Customer::where('mobile_no',$request->mobile)->first();
       
        if(empty($customer))
        {
            return response()->json(['status'=>'error','message'=>'Customer not exist'],401);
        }
        if(!Hash::check( $request->password,$customer->password))
        {
            return response()->json(['status'=>'error','message'=>'Password not match'],401);
        }
        else
        {
            return response(['status'=>'success','message'=>'success','data'=>$customer],200);
        }

    }

    public function store(Request $request)
    {
        
        if(empty(Customer::where('mobile_no',$request->mobile_no)->first()))
        {
            $customer = new Customer;
            $customer->customer_name = $request->customer_name;
            $customer->firm_name = $request->firm_name;
            $customer->mobile_no  = $request->mobile_no ;
            $customer->email = $request->email;
            $customer->password = Hash::make($request->password);
            $customer->address = $request->address;
            $customer->district = $request->district;
            $customer->city = $request->city;
            $customer->date_of_birth = $request->date_of_birth; 
            $customer->date_of_anniversary = $request->date_of_anniversary;
            $customer->save();
            return response()->json(['status'=>'success','message'=>'Customer registered successfully'],200);
        }
        else
        {
            return response()->json(['status'=>'error','message'=>'Customer already exist'],401);
        }
    }

    public function show(Customer $customer)
    {
        abort_if(Gate::denies('customer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CustomerResource($customer);
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());

        return (new CustomerResource($customer))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Customer $customer)
    {
        abort_if(Gate::denies('customer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customer->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    
}
