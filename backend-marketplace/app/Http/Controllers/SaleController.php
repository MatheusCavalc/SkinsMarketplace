<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class SaleController extends Controller
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
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }

    /**
     * public function sale()
     *{
     *    $sale = Sale::with('skin')->where('seller_id', auth()->user()->id)->get();
     *
     *       return $this->response('My Sales', 200, $sale);
     *  }
     *
     *   public function buy()
     *  {
     *     $buy = Sale::with('skin')->where('buyer_id', auth()->user()->id)->get();
     *
     *       return $this->response('My Acquisitions', 200, $buy);
     *}
     */
}
