<?php

namespace App\Http\Controllers;

use App\Models\Course;

class IndexController extends Controller
{

    public function index(){



        $courses = Course::all();


        return Inertia('Index/Index', [
            'courses' => $courses,
        ]);

    }


    public function show() {
        return Inertia('Index/Show');
    }
}
