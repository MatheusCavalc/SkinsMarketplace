<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function skins()
    {
        $skins = auth()->user()->skins;

        return $this->response('My Skins', 200, $skins);
    }

    public function skinsForSale()
    {
        $skins = auth()->user()->skinsForSale;

        return $this->response('My Skins For Sale', 200, $skins);
    }

    public function sale()
    {
        $sale = Sale::with('skin')->where('seller_id', auth()->user()->id)->get();

        return $this->response('My Sales', 200, $sale);
    }

    public function buy()
    {
        $buy = Sale::with('skin')->where('buyer_id', auth()->user()->id)->get();

        return $this->response('My Acquisitions', 200, $buy);
    }

    public function notifications()
    {
        $notifications = Sale::with('skin')
            ->where('buyer_id', auth()->user()->id)
            ->orWhere('seller_id', auth()->user()->id)
            ->latest()
            ->get();

        return $this->response('My Notifications', 200, [
            'notifications' => $notifications,
            'user_id' => auth()->user()->id
        ]);
    }
}
