<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserSkin;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class SkinController extends Controller
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
    public function show(UserSkin $userSkin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'for_sale' => 'required|boolean',
            'price' => 'required|numeric',
        ]);
        
        $userSkin = UserSkin::where('id', $id)->first();

        $userSkin->update([
            'for_sale' => $request->for_sale,
            'price' => $request->price,
        ]);

        return $this->response('Update Skin', 200, $userSkin);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserSkin $userSkin)
    {
        //
    }
}
