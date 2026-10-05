<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;

use Illuminate\Http\Request;


class ApplicationController extends Controller
{
    public function store(Request $request, Job $job)
    {
        $user = $request->user();
        $alreadyApplied = $user->applications()
            ->where('job_id', $job->id)
            ->exists();

        if ($alreadyApplied) {
            return back()->with('error', 'You have already applied for this job.');
        }

        $user->applications()->create([
            'job_id' => $job->id,
        ]);

        return back()->with('success', 'Application submitted successfully.');
    }
    public function index(Request $request)
    {
        $user = $request->user();
        $applications = $user->applications()->with('job')->get();

        return view('applications.index' , ['applications' => $applications]) ;
    }

    public function employerApplications(Request $request){
        $user = $request->user();
        $employer = $user->employer ;
        $jobs = $employer->jobs()->with('applications.user')->get();

        return view('employer.applications.index' , ['jobs' => $jobs]) ;

    }

    public function updateApplicationStatus(Request $request , Application $application){
        $employer = $request->user()->employer ;
        $attribute = $request->validate(['status' => ['required', 'in:accepted,rejected']]) ;
        $status = $attribute['status'] ;
        abort_unless($application->job->employer_id === $employer->id, 403);
       $application->update(['status'=>$status]) ;

      return back()->with('success', 'Application ' . $status . ' successfully.');

    }
}
