<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function fetchData()
    {
        $products = Product::inRandomOrder()->limit(4)->get();


        return view('/index', compact('products'));
    }
    public function addToCart($id)
    {
        $products = Product::where('p_id', $id)->first();
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $products->p_name,
                "quantity" => 1,
                "price" => $products->p_price,
                "image" => $products->path
            ];
        }
        $userData = [
            "user_id" => Auth::user()->id, 
        ];
        session(['user_data' => $userData]);
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product has been added to the cart!');
    }

    public function fetchAllData()
    {
        $products = Product::all();
        return view('shop', compact('products'));
    }
    public function deleteProduct(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Product successfully Remove From Cart');
        }
    }

}