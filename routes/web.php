<?php

use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployerDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobSeekerDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'featuredJobs']);


Route::get('/companies', [CompanyController::class, 'index']);
Route::get('/companies/{employer}', [CompanyController::class, 'companyDetails'])
    ->name('companies.show');

Route::get('/about', function () {
    return view('about');
});

Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);

Route::get('/company-profile', [CompanyProfileController::class, 'create'])
    ->middleware(['auth', 'employer']);

Route::post('/company-profile', [CompanyProfileController::class, 'store'])
    ->middleware(['auth', 'employer']);
Route::post('/logout', [SessionController::class, 'destroy']);

Route::get('/employer/jobs/create', [JobController::class, 'create'])
    ->middleware(['auth', 'employer'])
    ->name('jobs.create');

Route::post('/employer/jobs', [JobController::class, 'store'])
    ->middleware(['auth', 'employer']);

Route::get('/employer/jobs/', [JobController::class, 'index'])->middleware(['auth', 'employer']);
Route::get('/employer/jobs/{job}/edit', [JobController::class, 'edit'])
    ->middleware(['auth', 'employer']);
Route::put('/employer/jobs/{job}', [JobController::class, 'update'])
    ->middleware(['auth', 'employer']);


Route::delete('/employer/jobs/{job}', [JobController::class, 'destroy'])
    ->middleware(['auth', 'employer']);

Route::get('/jobs', [JobController::class, 'publicIndex'])->name('jobs.index');
Route::get('/jobs/{job}', [JobController::class, 'jobDetails'])->name('jobs.show');

Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])
    ->middleware(['auth', 'job_seeker'])
    ->name('applications.store');

Route::get('/applications', [ApplicationController::class, 'index'])
    ->middleware(['auth', 'job_seeker']);
Route::get('/employer/applications', [ApplicationController::class, 'employerApplications'])
    ->name('employer.applications.index')
    ->middleware(['auth', 'employer']);

Route::patch('/employer/applications/{application}', [ApplicationController::class, 'updateApplicationStatus'])
    ->name('employer.applications.update')
    ->middleware(['auth', 'employer']);

Route::get('/employer/dashboard', [EmployerDashboardController::class, 'index'])
    ->middleware(['auth', 'employer']);

Route::get('/job-seeker/dashboard', [JobSeekerDashboardController::class, 'index'])
    ->middleware(['auth', 'job_seeker']);

Route::get('/profile', [ProfileController::class, 'show'])
    ->middleware('auth');


Route::get('/profile/edit', [ProfileController::class, 'edit'])
    ->middleware('auth');

Route::put('/profile', [ProfileController::class, 'update'])
    ->middleware('auth');

Route::get('/language/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'ar'])) {
        abort(404);
    }

    session(['locale' => $locale]);

    return back();
});
