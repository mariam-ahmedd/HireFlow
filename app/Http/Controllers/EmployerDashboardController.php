<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployerDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $employer = $user->employer;

        $jobs = $employer->jobs;

        $totalJobs = $jobs->count() ;

       $totalApplications = $jobs->sum(fn($job) => $job->applications->count());
       $totalPending = $jobs->sum(fn($job) => $job->applications->where('status' , 'pending')->count());
       $totalAccepted = $jobs->sum(fn($job) => $job->applications->where('status' , 'accepted')->count());
       $totalRejected = $jobs->sum(fn($job) => $job->applications->where('status' , 'rejected')->count());

       return view('employer.dashboard.index' , [
        'totalJobs' => $totalJobs ,
        'totalApplications' => $totalApplications ,
        'totalPending' => $totalPending ,
        'totalAccepted' => $totalAccepted ,
        'totalRejected' => $totalRejected ,
       ]) ; 

    }
}
