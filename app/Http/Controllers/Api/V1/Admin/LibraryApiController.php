<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLibraryRequest;
use App\Http\Requests\UpdateLibraryRequest;
use App\Http\Resources\Admin\TamhubLibraryResource;
use App\Models\Library;
use App\Models\LibraryCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LibraryApiController extends Controller
{
    public function index (Request $request) {
        $librarys = Library::with('LibraryCategory')->get();
        $data = array();
        $getLibrary = array();
        if(!empty($librarys)) {
            foreach($librarys as $library) {

                $data['id']                   = $library->id;
                $data['library_category_id']  = $library->LibraryCategory->library_category;
                $data['subtopic_one']         = $library->subtopic_one;
                $data['subtopic_two']         = $library->subtopic_two;
                $data['title']                = $library->title;
                $data['link']                 = $library->link;
                $data['source']               = $library->source;
                $data['description']          = $library->description;
                $getLibrary = $data;
            }
        }
        $response = ['response' => $getLibrary,'message'=> 'Library Record Successfully.....!','status'=>true];
        return response($response, 200);
    }

    public function store(Request $request) 
    {
        $tamLibraryCategorys = LibraryCategory::where('id',$request->library_category_id)->first();
        if(!empty($tamLibraryCategorys))
        {
                $response = Library::where('library_category_id',$tamLibraryCategorys->id)->get();
                $response = ['response' => $response,'message'=> 'Tamhub Library Category Record Successfully.....!','status'=>true];
                return response($response, 200);
                die();
        }else{
            $response = ["message" => "Library Category does not exit",'status'=>FALSE];
            return response($response, 422);
            die();
        }
    }
}
