<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CounselorAssignmentResource;
use App\Models\CounselorAssignment;
use App\Models\WaitingAssignments;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CounselorAssignmentApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('library_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new CounselorAssignmentResource(Library::get());
    }

    public function store(Request $request)
    {
        $getCounselors  = User::where('category_id',$request->category_id)
                             ->where('status','2')
                             ->where('counselor_availability','1')
                             ->where('chat_availability','0')
                             ->get();
     
        $counselorAssignment = array();
        $userAssignment = array();
        $checkCounselor = array();
        if(!empty($getCounselors))
        {
            foreach($getCounselors as $getCounselor)
            {
                $userAssignment['counselor_id'] = $getCounselor->id;
                $userAssignment['user_id'] = 5;
                $userAssignment['category_id'] = 1;
                $userAssignment['chat_type'] = "Live";
                $userAssignment['availability'] = $getCounselor->counselor_availability;
                $counselorAssignment = $userAssignment; 
                $checkCounselor = CounselorAssignment::create($counselorAssignment);
            }
        }
        if(empty($checkCounselor))
        {
                $userAssignment['user_id'] = 7;
                $userAssignment['category_id'] = 1;
                $userAssignment['waiting_status'] ='1';
                $WaitingAssignments = $userAssignment; 
                $checkCounselor = WaitingAssignments::create($WaitingAssignments);
        }
        
        return (new CounselorAssignmentResource($checkCounselor))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpdateLibraryRequest $request, Library $library)
    {
        $library->update($request->all());
        return (new CounselorAssignmentResource($library))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Library $library)
    {
        abort_if(Gate::denies('library_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $library->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
