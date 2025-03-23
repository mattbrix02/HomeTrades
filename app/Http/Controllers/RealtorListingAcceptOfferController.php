<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class RealtorListingAcceptOfferController extends Controller
{

    use AuthorizesRequests;

    public function __invoke(Offer $offer){

        $listing = $offer->listing;
        $this->authorize('update',$listing);
        //Accept the offer
        $offer->update(['accepted_at' => now()]);

        $listing->sold_at = now();
        $listing->save();

        //Reject other offers
        $listing->offers()->except($offer)->update(['rejected_at' => now()]);


        return redirect()->back()->with('success',"Offer #{$offer->id} accepted, other offer has been automatically rejected!");
    }
}
