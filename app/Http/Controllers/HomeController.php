<?php

namespace App\Http\Controllers;

use App\Factory;
//use App\Product;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }
*/
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('home');
        $objProduct = Factory::create('product');
        $products = $objProduct::where('condition','1')->where('stock','>','0')->orderBy('id','desc')->paginate(10);
        return view('product.index',['products'=>$products]);

    }
}
