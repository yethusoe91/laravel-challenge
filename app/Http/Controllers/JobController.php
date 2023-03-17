<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobApplyRequest;
use App\Services\EmployeeManagement\Applicant;
use Illuminate\Http\Request;

class JobController extends Controller
{
    protected $applicant;
    
    public function __construct(Applicant $applicant)
    {
        $this->applicant = $applicant;
    }
    
    public function apply(JobApplyRequest $request)
    {
        $data = $this->applicant->applyJob();
        
        return response()->json([
            'data' => $data
        ]);
    }
}
