<?php


namespace App\Http\Controllers;

use Aimeos\Client\Html\Account\Favorite\Standard;
use Aimeos\Shop\Facades\Shop;

class FavoriteController extends Controller
{
    public function index()
    {
        foreach (config('shop.page.account-favorite') as $name) {
            $aiheader['account/favorite'] = Shop::get($name)->getHeader();
            $aibody['account/favorite'] = Shop::get($name)->getBody();
        }

        return view('vendor.shop.account.favorite')->with([
            'aiheader' => $aiheader,
            'aibody' => $aibody
        ]);
    }
}
