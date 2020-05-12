<?php

namespace App\Http\Controllers\API;
use App\Item;
use App\Order;
use App\CartItem;
use App\CategoryType;
use App\Helpers\APIHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function addToOrder(Request $request)
    {
        try {

            $order = new Order();
            $total_amount = 0;
            foreach($request->cart_items as $cart_item){
                $item = Item::find($cart_item['item_id']);
                $item->quantity = $item->quantity - $cart_item['quantity'];
                $item->save();
                $cart = new CartItem();
                $cart->quantity = $cart_item['quantity'];
                $cart->item_id = $item->id;
                $cart->price = $item->price;
                $cart->discount = $item->discount;
                $cart->order_id = Order::all()->count() + 1;
                $cart->save();
                $order->shop_id = $item->shop_id;
                $total_amount = ($item->price - $item->discount)*($cart->quantity) + $total_amount;

            }
            $order->user_id = Auth::user()->id;
            $order->total_amount = $total_amount;
            $order->delivery_address = $request->input('delivery_address');
            $order->status = 'pending';
            $order->save();
            return APIHelper::makeAPIResponse(true, "Order Added",null, 200);

        } catch (\Exception $e) {
            report($e);
            return APIHelper::makeAPIResponse(false, "Service error", null, 500);
        }

    }

    public function getAllOrders($id)
    {
        try {
            $user_id = Auth::user()->id;
            $order = Order::where('shop_id',$id & 'user_id',$user_id) ->orderBy('id', 'desc')->get();

           return APIHelper::makeAPIResponse(true, "All Orders ",$order, 200);
       }
       catch (\Exception $e) {
           report($e);
           return APIHelper::makeAPIResponse(false, "Service error", null, 500);
       }

    }

    public function getOrderById($id)
    {
        try {
            $order = Order::find($id);

           return APIHelper::makeAPIResponse(true, "Order Found",$order, 200);
       }
       catch (\Exception $e) {
           report($e);
           return APIHelper::makeAPIResponse(false, "Service error", null, 500);
       }

    }
    public function cancelOrder($id)
    {
        try {
            $order = Order::find($id);
            $order->delete();

           return APIHelper::makeAPIResponse(true, "order Cancelled",null, 200);
       }
       catch (\Exception $e) {
           report($e);
           return APIHelper::makeAPIResponse(false, "Service error", null, 500);
       }

    }
}
