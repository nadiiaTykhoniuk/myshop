<?php

namespace App\Http\Controllers;

use Aimeos\Client\Html\Customized;
use Illuminate\Http\Request;
use Aimeos\Shop\Facades\Shop;

class CustomizedController extends Controller
{
    public function index()
    {
        foreach( config( 'shop.page.customized' ) as $name )
        {
            $aiheader['test/customized'] = Shop::get( $name )->getHeader();
            $aibody['test/customized'] = Shop::get( $name )->getBody();
        }

        return view('vendor.test.customized')->with([
            'aiheader' => $aiheader,
            'aibody' => $aibody
        ]);
    }
}
