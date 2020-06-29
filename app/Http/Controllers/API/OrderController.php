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
    public function addToOrder(Request $request,$id)
    {
        try {

            $order = new Order();
            $total_amount = 0;
            $user_id = Auth::user()->id;
            $cart_items = CartItem::where('shop_id',$id)->where('user_id',$user_id)->where('order_id',Null)->get();
            foreach ($cart_items as $cart) {
                $item = Item::with('quantityType')->find($cart['item_id']);
                if ($item->quantityType->name == 'piece') {
                    $total_amount = ($item->price - $item->discount) * ($cart['quantity']) + $total_amount;
                } elseif ($item->quantityType->name == 'loose') {
                    $total_amount = ($item->price - $item->discount) * (($cart['quantity']) / 1000) + $total_amount;
                } else {
                    $total_amount = ($item->price - $item->discount) * (($cart['quantity']) / 1000) + $total_amount;
                }

                $cart->price = $item->price;
                $cart->discount = $item->discount;
                $cart->order_id = Order::withTrashed()->count('id') + 1;
                $cart->save();
                $order->shop_id = $id;
            }
            $order->user_id = Auth::user()->id;
            $order->total_amount = $total_amount;
            $order->delivery_address = $request->input('delivery_address');
            $order->status = 'pending';
            $result = $order->save();

            return APIHelper::makeAPIResponse(true, "Order Added", null, 200);


        } catch (\Exception $e) {
            $cartItems = CartItem::where('order_id', Order::all()->count() + 1)->with('item')->get();
            foreach ($cartItems as $cartItem) {
                $item = Item::find($cartItem->item_id);
                $item->quantity = $cartItem->quantity + $item->quantity;
                $item->save();
                $cartItem->delete();
            }
            report($e);
            return APIHelper::makeAPIResponse(false, "Service error", null, 500);
        }
    }

    public function getAllOrders($id)
    {
        try {
            $user_id = Auth::user()->id;
            $orders = Order::where('user_id', $user_id)->where('shop_id', $id)->orderBy('id', 'desc')->get();
            return APIHelper::makeAPIResponse(true, "All Orders ", $orders, 200);
        } catch (\Exception $e) {
            report($e);
            return APIHelper::makeAPIResponse(false, "Service error", null, 500);
        }
    }

    public function getOrderById($id)
    {
        try {
            $order = Order::where('id', $id)->with('cart')->first();


            foreach ($order->cart as $cartItem) {
                $item = Item::with('quantityType')->find($cartItem->item_id);
                if ($item->quantityType->name == 'loose') {
                    $cartItem->quantity = APIHelper::getQuantity($cartItem->quantity);
                } elseif ($item->quantityType->name == 'liquide') {
                    $cartItem->quantity = APIHelper::getVolumeQuantity($cartItem->quantity);
                }
                $cartItem->name = $item->name;
                $cartItem->description = $item->description;
                $cartItem->image_url = $item->image_url;
            }

            return APIHelper::makeAPIResponse(true, "Order Found", $order, 200);
        } catch (\Exception $e) {
            report($e);
            return APIHelper::makeAPIResponse(false, "Service error", null, 500);
        }
    }
    public function cancelOrder($id) //order remove item
    {
        try {
            $order = Order::where('id', $id)->with('cart')->first();
           

            if($order->status == 'completed' or 'rejected'){
                dd($order->status);
                return APIHelper::makeAPIResponse(true, "order cancellation failed, please contact the shop", null, 404);
            }
            else{
                foreach ($order->cart as $cartItem) {
                    $cart_item = Item::find($cartItem->id);
                    $cart_item->delete();
                }
                
                $order->delete();
                return APIHelper::makeAPIResponse(true, "order Cancelled", null, 200);
            }


            return APIHelper::makeAPIResponse(true, "order Cancelled", null, 200);
        } catch (\Exception $e) {
            report($e);
            return APIHelper::makeAPIResponse(false, "Service error", null, 500);
        }
    }
}
