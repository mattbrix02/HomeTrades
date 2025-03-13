<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ListingController extends Controller
{

    public function index(Request $request)
    {
        $filters =  $request->only(['priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo']);

        Gate::authorize('viewAny', Listing::class);

        return Inertia(
            'Listing/Index', [
                'listings'=> Listing::mostRecent()->Filter($filters)->paginate(10)->withQueryString(),
                'filters' => $filters,
            ]
        );
    }



    public function show(Listing $listing)
    {
        if (Gate::inspect('view', $listing)->denied()) {
            return redirect()->route('listings.index')->with('error', 'Listing not accesible.');
        }


        return Inertia(
            'Listing/Show', ['listing'=>$listing]
        );
    }



}
