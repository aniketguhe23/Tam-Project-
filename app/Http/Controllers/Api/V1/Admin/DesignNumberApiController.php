<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreDesignNumberRequest;
use App\Http\Requests\UpdateDesignNumberRequest;
use App\Http\Resources\Admin\DesignNumberResource;
use App\Models\DesignNumber;
use Gate;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DesignNumberApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        //abort_if(Gate::denies('design_number_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $designs = DesignNumber::with(['product'])->get();
        $data = array();
        if(!empty($designs))
        {
            foreach($designs as $design)
            {
                $dsn = array(
                    'id' => $design->id,
                    'design_name'=> $design->design_name,
                    'design_number'=> $design->design_number,
                    'remark' => $design->remark,
                    'product_id'=>$design->product_id,
                    
                );

                if($design->photos ? :  NULL)

                foreach($design->photos as $val)
                {
                    $dsn['img'][] = $val->url;
                }

                $data[] = $dsn;
            }
            return $data;
        }
        else
        {
             return $design;
        }
       
    }

    public function store(StoreDesignNumberRequest $request)
    {
        $designNumber = DesignNumber::create($request->all());

        if ($request->input('photos', false)) {
            $designNumber->addMedia(storage_path('tmp/uploads/' . $request->input('photos')))->toMediaCollection('photos');
        }

        return (new DesignNumberResource($designNumber))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DesignNumber $designNumber)
    {
        abort_if(Gate::denies('design_number_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DesignNumberResource($designNumber->load(['product']));
    }

    public function update(UpdateDesignNumberRequest $request, DesignNumber $designNumber)
    {
        $designNumber->update($request->all());

        if ($request->input('photos', false)) {
            if (!$designNumber->photos || $request->input('photos') !== $designNumber->photos->file_name) {
                if ($designNumber->photos) {
                    $designNumber->photos->delete();
                }

                $designNumber->addMedia(storage_path('tmp/uploads/' . $request->input('photos')))->toMediaCollection('photos');
            }
        } elseif ($designNumber->photos) {
            $designNumber->photos->delete();
        }

        return (new DesignNumberResource($designNumber))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DesignNumber $designNumber)
    {
        abort_if(Gate::denies('design_number_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $designNumber->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function get_shared_design_list(Request $request)
    {
        $sharedesign = DesignNumber::
        join('share_design_customer','share_design_customer.desing_id','design_numbers.id')
        ->where('share_design_customer.customer_id',$request->customer_id)
        ->get();

        $datas = array();

        if(!empty($sharedesign))
        {
            foreach($sharedesign as $shrdesin)
            {
                $d = array(
                    'desing_id' => $shrdesin->id,
                    'desing_name'=>$shrdesin->design_name,
                    'design_number'=>$shrdesin->design_number,
                    'customer_id'=>$shrdesin->customer_id
                );

                if($shrdesin->photos ? :  NULL)

                foreach($shrdesin->photos as $val)
                {
                    $d['img'][] = $val->url;
                }

                $datas[] = $d;
            }
            return response()->json(['status'=>'success','data'=>$datas],200);
        }
        else
        {
            return response()->json(['status'=>'error','message'=>'Record not found'],401);
        }
    }
}
