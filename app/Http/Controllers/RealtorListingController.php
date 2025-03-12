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
                                ->paginate(5)
                                ->withQueryString(),
                'filters' => $filters,
                ]
        );
    }

    public function destroy(Listing $listing)
    {
        if (Gate::inspect('delete', $listing)->denied()) {
            return redirect()->route('listings.index')->with('error', 'You are not allowed to delete someone else Listing.');
        }

        $listing->delete();

        return redirect()->back()->with('success', 'Listing was deleted!');
    }
}
