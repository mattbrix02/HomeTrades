<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function index(){

        return Inertia(
            'Index/Index', ['message'=>'Hello from Laravel22']


        );
    }


    public function show() {
        return inertia('Index/Show');
    }
}
