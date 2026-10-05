<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function featuredJobs(){
        $jobs = Job::where('featured', true)->get();

        return view('home', ['jobs' => $jobs]);
    }
}
