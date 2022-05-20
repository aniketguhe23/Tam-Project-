<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\Admin\ProductResource;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductApiController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        //abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $datas = Product::with(['product_category'])
        ->where('product_category_id',$request->product_category_id)->get();
        $product = array();
        if(!empty($datas))
        {
            foreach($datas as $data)
            {
                $pro = array(
                    'id' => $data->id,
                    'product_name' => $data->product_name,
                    'remark' => $data->remark,
                    'product_category_id' => $data->product_category_id,
                    'product_category' => $data->product_category->name
                );

                if($data->photos ? :  NULL)

                foreach($data->photos as $val)
                {
                    $pro['img'][] = $val->url;
                }
                
                $product[] = $pro;
            }
            return $product;
        }
        else
        {
            return $datas;
        }
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());

        if ($request->input('photos', false)) {
            $product->addMedia(storage_path('tmp/uploads/' . $request->input('photos')))->toMediaCollection('photos');
        }

        return (new ProductResource($product))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Product $product)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductResource($product->load(['product_category']));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());

        if ($request->input('photos', false)) {
            if (!$product->photos || $request->input('photos') !== $product->photos->file_name) {
                if ($product->photos) {
                    $product->photos->delete();
                }

                $product->addMedia(storage_path('tmp/uploads/' . $request->input('photos')))->toMediaCollection('photos');
            }
        } elseif ($product->photos) {
            $product->photos->delete();
        }

        return (new ProductResource($product))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Product $product)
    {
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
