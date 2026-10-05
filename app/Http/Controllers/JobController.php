<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function create()
    {
        return view('employer.jobs.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required'],
            'salary' => ['required'],
            'location' => ['required'],
            'schedule' => ['required'],
            'description' => ['required'],
            'url' => ['nullable', 'url'],
            'featured' => ['required', 'boolean'],
        ]);

        $employer =  $request->user()->employer->id;
        $attributes['employer_id'] = $employer;

        Job::create($attributes);
        return redirect('/');
    }

    public function index(Request $request)
    {
        $jobs =  $request->user()->employer->jobs;

        return view('employer.jobs.index', ['jobs' => $jobs]);
    }

    public function edit(Request $request, Job $job)
    {
        if ($job->employer_id !== $request->user()->employer->id) {
            abort(403);
        }

        return view('employer.jobs.edit', ['job' => $job]);
    }

    public function update(Request $request, Job $job)
    {
        $attributes = $request->validate([
            'title' => ['required'],
            'salary' => ['required'],
            'location' => ['required'],
            'schedule' => ['required'],
            'description' => ['required'],
            'url' => ['nullable', 'url'],
            'featured' => ['required', 'boolean'],
        ]);

        if ($job->employer_id !== $request->user()->employer->id) {
            return abort(403);
        }
        $job->update($attributes);
        return redirect('/employer/jobs/');
    }

    public function destroy(Request $request, Job $job)
    {
        if ($job->employer_id !== $request->user()->employer->id) {
            abort(403);
        }

        $job->delete();

        return redirect('/employer/jobs/');
    }


    public function publicIndex(Request $request)
    {
        $search = $request->input('search');
        $location = $request->input('location');

        $query = Job::query();

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($location) {
            $query->where('location', 'like', '%' . $location . '%');
        }

        $jobs = $query->get();

        return view('jobs.index', ['jobs' => $jobs]);
    }

    public function jobDetails(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }
}
