<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessSale;
use App\Models\Sale;
use App\Models\UserSkin;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    use HttpResponses;

    public function checkout(Request $request)
    {
        $skinIds = $request->ids;

        $skins = UserSkin::with('user', 'skin')->whereIn('id', $skinIds)->get();

        $totalPrice = $skins->sum('price');

        $buyerCredits = auth()->user()->credits;

        if ($buyerCredits >= $totalPrice) {
            auth()->user()->decrement('credits', $totalPrice);

            foreach ($skins as $skin) {
                $seller = $skin->user;
                $seller->increment('credits', $skin->price);

                Sale::create([
                    'seller_id' => $seller->id,
                    'buyer_id' => auth()->user()->id,
                    'skin_id' => $skin->skin->id,
                    'price' => $skin->price,
                ]);
            }

            UserSkin::whereIn('id', $skinIds)->update([
                'user_id' => auth()->user()->id,
                'for_sale' => false
            ]);

            return $this->response('Confirm Buy', 200, [
                'total_price' => $totalPrice,
                'user_credits_before' => $buyerCredits,
                'after' => auth()->user()->credits
            ]);
        } else {
            return $this->response('Error', 200, []);
        }
    }

    public function checkoutJob(Request $request)
    {
        $skinIds = $request->ids;

        //Job (Work on Queue)
        ProcessSale::dispatch($skinIds, auth()->user());

        return $this->response('Process in work', 200, []);
    }
}
