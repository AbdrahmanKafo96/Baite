<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Resources\Cart as ResourcesCart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\JsonDecoder;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(
            ResourcesCart::collection(Cart::where('user_id', operator: Auth::user()->id)->get())
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {}
    public function show(Cart $cart)
    {
        return response()->json(['result' => $cart, 'total' => $cart->service->cost]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $service_id = $request->service_id;
        //logic the quantities
        $cart = Cart::where('user_id',   Auth::user()->id)->where('service_id',  $service_id)->first();

        Cart::create([
            'user_id' =>  Auth::user()->id,
            'service_id' =>  $service_id,
          //  'quantities' => $request->quantities,
        ]);

        return response()->json(['message' => 'insert success']);
    }


    // function checkTotal($total, $productSelected)
    // {
    //     if ($total >= 0) {
    //         $productSelected->inventory = $total;
    //         $productSelected->save();
    //         return true;
    //     } else {
    //         return false;
    //     };
    // }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($cart)
    {
        $cart = Cart::find($cart);
        if (!$cart) {
            return response()->json(['message' => 'not found'], 404);
        }
        $cart->delete();
        return response()->json(['message' => 'remove success']);
    }
}
