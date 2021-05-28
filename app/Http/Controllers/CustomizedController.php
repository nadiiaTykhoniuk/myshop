<?php

namespace App\Http\Controllers;

use Aimeos\Client\Html\Customized;
use Illuminate\Http\Request;
use Aimeos\Shop\Facades\Shop;

class CustomizedController extends Controller
{
//    public function index()
//    {
//        foreach( config( 'shop.page.customized' ) as $name )
//        {
//            $params['aiheader'][$name] = Shop::get( $name )->getHeader();
//            //$params['aibody'][$name] = Shop::get( $name )->getBody();
//        }
//
//        return view('vendor.test.customized');
//        //return \View::make('vendor.customized.standard', $params);
//    }

    public function index()
    {
        $aibody['test/customized'] = Shop::get('test/customized')->getBody();
        return view('vendor.test.customized')->with(['aibody' => $aibody]);
    }
}
