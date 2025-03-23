<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RealtorListingController extends Controller
{
    public function index(Request $request){

        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request->only(['by','order'])
        ];

        if (Gate::inspect('realtorViewAny', Listing::class)->denied()) {
            return redirect()->route('listings.index')->with('error', 'You are not allowed to view this listing.');
        }

        return inertia('Realtor/index',
        ['listings' => Auth::user()
                                ->listings()
                                ->filter($filters)
                                ->withCount('images')
                                ->withCount('offers')
                                ->paginate(5)
                                ->withQueryString(),
                'filters' => $filters,
                ]
        );
    }


    public function show(Listing $listing){


        return inertia('Realtor/Show',['listing' => $listing->load('offers','offers.bidder')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Listing $listing)
    {
        if (Gate::inspect('create', $listing)->denied()) {
            return redirect()->route('realtor.listing.index')->with('error', 'You are not allowed to create New Listing.');
        }

        return Inertia(
            'Realtor/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Gate::inspect('create', Listing::class)->denied()) {
            return redirect()->route('realtor.listing.index')->with('error', 'Listing not accesible.');
        }

        $request->user()->listings()->create(
            $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'required|integer|min:15|max:1500',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|min:1|max:1000',
                'price' => 'required|integer|min:1|max:20000000'
            ])
        );


        return redirect()->route('realtor.listing.index')->with('success','Listing was created!');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        if (Gate::inspect('update', $listing)->denied()) {
            return redirect()->route('realtor.listing.index')->with('error', 'You are not allowed to edit someone else Listing.');
        }

        return Inertia(
            'Realtor/Edit', ["listing" => $listing]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {

        if (Gate::inspect('update', $listing)->denied()) {
            return redirect()->route('realtor.listing.index')->with('error', 'You are not allowed to update someone else Listing.');
        }

        $listing->update($request->validate([
            'beds' => 'required|integer|min:0|max:20',
            'baths' => 'required|integer|min:0|max:20',
            'area' => 'required|integer|min:15|max:1500',
            'city' => 'required',
            'code' => 'required',
            'street' => 'required',
            'street_nr' => 'required|min:1|max:1000',
            'price' => 'required|integer|min:1|max:20000000'
        ])
    );

    return redirect()->route('realtor.listing.index')->with('success','Listing was updated!');
    }

    public function destroy(Listing $listing)
    {
        if (Gate::inspect('delete', $listing)->denied()) {
            return redirect()->route('realtor.listing.index')->with('error', 'You are not allowed to delete someone else Listing.');
        }

        $listing->delete();

        return redirect()->back()->with('success', 'Listing was deleted!');
    }

    public function restore(Listing $listing){

        $listing->restore();

        return redirect()->back()->with('success', 'Listing was restored!');
    }
}
