<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Builders\AttachmentBuilder;
use App\Models\Cart;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        return response()->json(

            data: Order::orderBy('created_at')->paginate($request->limit)
        );
    }

    public function show(Order $order)
    {
        return response()->json($order);
    }


    public function store(Request $request)
    {
        $prefix = "#";
        $randomNumber = IdGenerator::generate(['table' => 'orders', 'field' => 'order_number', 'length' => 9, 'prefix' => $prefix]);

        $user_id = Auth::user()->id;
        $carts = Cart::where('user_id',   $user_id)->get();
        $itemsSelected = [];
        $quantitySelected = [];

        foreach ($carts as $item) {
            $itemsSelected[] = $item->service_id;
            $quantitySelected[] = $item->quantities;
        }

        Order::create([
            'order_number' =>  $randomNumber,
            'note' => $request->note,
            'status' =>  "pending",
            'service_seclected' => $itemsSelected,
            'quantity_selected' =>  $quantitySelected,
            'phone_number' => Auth::user()->phone_number,
            'total_price' => $request->total_price,
            'user_id' =>   $user_id,
            'service_id' => $request->service_id,
        ]);

        return response()->json(['message' => 'insert success']);
    }

    public function update(UpdateOrderRequest $request, Order $order) {}

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(['message' => 'delete success']);
    }

    public function search($search_value)
    {

        $query =   Order::where('order_number', $search_value)->orderBy('created_at')->paginate(10);
        return response()->json(
            $query,
        );
    }
    // function enableService(Order $order)
    // {
    //     //$this->authorize('chnageCustomerActiveStatus', Customer::class);
    //     $user = Order::find($order->id);
    //     $user->update(['show' => $order->is_active]);
    //     return response()->json(['message' =>
    //     'status was chnaged successfully']);
    // }
}
