<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerOrderRequest;
use App\Http\Requests\UpdateCustomerOrderRequest;
use App\Http\Resources\Admin\CustomerOrderResource;
use App\Models\CustomerOrder;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerOrdersApiController extends Controller
{
    public function index(Request $request)
    {
        //abort_if(Gate::denies('customer_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = CustomerOrder::with(['customer', 'design'])
        ->where('customer_id',$request->customer_id)->get();
        return $orders;
    }

    public function store(Request $request)
    {
        $customerOrder = new CustomerOrder;
        $customerOrder->purity = $request->purity;
        $customerOrder->weight = $request->weight;
        $customerOrder->size = $request->size;
        $customerOrder->quantity = $request->quantity;
        $customerOrder->delivery_date = $request->delivery_date;
        $customerOrder->customer_id  = $request->customer_id;
        $customerOrder->design_id  = $request->design_id;
        $customerOrder->save();
        return response()->json(['status'=>'success','message'=>'Order create successfully'],200);
    }

    public function show(CustomerOrder $customerOrder)
    {
        abort_if(Gate::denies('customer_order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CustomerOrderResource($customerOrder->load(['customer', 'design']));
    }

    public function update(UpdateCustomerOrderRequest $request, CustomerOrder $customerOrder)
    {
        $customerOrder->update($request->all());

        return (new CustomerOrderResource($customerOrder))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CustomerOrder $customerOrder)
    {
        abort_if(Gate::denies('customer_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customerOrder->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
