<?php

namespace App\Http\Controllers;

use App\Models\Skin;
use App\Models\UserSkin;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use HttpResponses;

    public function home()
    {
        $skins = UserSkin::with('skin', 'user')
            ->where('for_sale', true)
            ->latest()
            ->take(15)
            ->get();

        return $this->response('Last Skins for Sale', 201, [
            'skins' => $skins
        ]);
    }

    public function search(Request $request)
    {
        $skins = Skin::where('name', 'LIKE', "%{$request->search}%")->limit(5)->get();

        return $this->response('Search List', 200, $skins);
    }
}
