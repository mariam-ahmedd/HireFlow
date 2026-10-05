<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employer;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(){
        $employers = Employer::withCount('jobs')->get() ;
        return view('companies.index' , ['employers' => $employers]) ;
    }

    public function companyDetails(Employer $employer){
        return view('companies.show' , ['employer' => $employer]) ;
    }
}
