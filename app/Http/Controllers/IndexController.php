<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function index(Request $request){

        $filters =  $request->only(['search']);


        $courses = Course::all();

        $courses = Course::with('createdby:id,first_name,last_name')
        ->Filter($filters)
        ->paginate(10)
        ->withQueryString();

        return Inertia('Index/Index', [
            'courses' => $courses,
        ]);

    }


    public function show() {
        return Inertia('Index/Show');
    }
}
