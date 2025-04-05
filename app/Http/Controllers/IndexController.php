<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function index(){

        return Inertia(
            'Index/Index', [
                'recentListings'=> Listing::mostRecent()->withoutSold()->take(10)->get()

                ]
        );
    }


    public function show() {
        return inertia('Index/Show');
    }
}
