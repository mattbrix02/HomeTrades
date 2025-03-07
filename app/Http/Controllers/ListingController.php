<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters =  $request->only(['priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo']);

        $query = Listing::orderByDesc('created_at')
            ->when(
            $filters['priceFrom'] ?? false,
            fn($query, $value) => $query->where('price','>=',$value)
            )
            ->when(
                $filters['priceTo'] ?? false,
                fn($query, $value) => $query->where('price','<=',$value)
            )
            ->when(
                $filters['beds'] ?? false,
                fn($query, $value) => $query->where('beds',(int)$value < 6 ? '=' : '>=',$value)
            )
            ->when(
                $filters['baths'] ?? false,
                fn($query, $value) => $query->where('baths',(int)$value < 6 ? '=' : '>=',$value)
            )
            ->when(
                $filters['areaFrom'] ?? false,
                fn($query, $value) => $query->where('area','>=',$value)
                )
            ->when(
                $filters['areaTo'] ?? false,
                fn($query, $value) => $query->where('area','<=',$value)
            );

        return Inertia(
            'Listing/Index', [
                'listings'=> $query->paginate(10)->withQueryString(),
                'filters' => $filters,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Listing $listing)
    {
        if (! Gate::inspect('create', $listing)->allowed()) {
            return redirect()->route('listings.index')->with('error', 'You are not allowed to create New Listing.');
        }

        return Inertia(
            'Listing/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! Gate::inspect('create', $request)->allowed()) {
            return redirect()->route('listings.index')->with('error', 'Listing not accesible.');
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


        return redirect()->route('listings.index')->with('success','Listing was created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {


        if (! Gate::inspect('view', $listing)->allowed()) {
            return redirect()->route('listings.index')->with('error', 'Listing not accesible.');
        }


        return Inertia(
            'Listing/Show', ['listing'=>$listing]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        if (! Gate::inspect('update', $listing)->allowed()) {
            return redirect()->route('listings.index')->with('error', 'You are not allowed to edit someone else Listing.');
        }

        return Inertia(
            'Listing/Edit', ["listing" => $listing]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {

        if (! Gate::inspect('update', $listing)->allowed()) {
            return redirect()->route('listings.index')->with('error', 'You are not allowed to update someone else Listing.');
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

    return redirect()->route('listings.index')->with('success','Listing was updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        if (! Gate::inspect('delete', $listing)->allowed()) {
            return redirect()->route('listings.index')->with('error', 'You are not allowed to delete someone else Listing.');
        }

        $listing->delete();

        return redirect()->back()->with('success', 'Listing was deleted!');
    }
}
