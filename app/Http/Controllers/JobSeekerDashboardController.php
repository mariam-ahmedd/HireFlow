<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobSeekerDashboardController extends Controller
{
    public function index(Request $request){
        $user = $request->user() ;
        $applications = $user->applications ;
        $totalApplications = $applications->count() ;
        $totalPending = $applications->where('status' , 'pending')->count() ;
        $totalAccepted = $applications->where('status' , 'accepted')->count() ;
        $totalRejected = $applications->where('status' , 'rejected')->count() ;

        return view('job-seeker.dashboard.index' , [
        'totalApplications' => $totalApplications , 
        'totalPending' => $totalPending ,
        'totalAccepted' => $totalAccepted ,
        'totalRejected' => $totalRejected ,
       ]) ;
    }
}
