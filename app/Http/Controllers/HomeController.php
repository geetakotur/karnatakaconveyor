<?php

namespace App\Http\Controllers;

use App\Models\Mgmt\Conveyor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Home
    public function index(Request $request)
    {
        $machines = Conveyor::get();

        return view('view.home.index')->with([
            'machines' => $machines,
        ]);
    }

    // Contact Us
    public function contact(Request $request)
    {

        return view('view.home.contact')->with([
        ]);
    }

    // About Us
    public function about(Request $request)
    {

        return view('view.home.about')->with([
        ]);
    }

    // products
    public function products(Request $request)
    {
        $products = Conveyor::get();

        return view('view.home.products')->with([
            'products' => $products,
        ]);
    }

    // View Product By ID
    public function productById(Request $request, $id)
    {
        $product = Conveyor::where('modelno', $id)->get();
        // dd($product);

        if($product && sizeof($product) > 0){
            $product = $product->first();
        }else{
            // $product = NULL;
            dd("invalid product model");
        }

        return view('view.home.product')->with([
            'product' => $product,
        ]);
    }
}
