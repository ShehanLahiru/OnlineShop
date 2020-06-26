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
            $quantityAvailible = true;
            foreach ($request->cart_items as $cart_item) {
                $item = Item::with('quantityType')->find($cart_item['item_id']);

                $cart = new CartItem();
                if ($item->quantityType->name == 'piece') {
                    $cart->quantity = $cart_item['quantity1'];
                    $total_amount = ($item->price - $item->discount) * ($cart->quantity) + $total_amount;
                } elseif ($item->quantityType->name == 'loose') {
                    $cart->quantity = APIHelper::getWeight($cart_item["quantity1"], $cart_item["quantity2"]);
                    $total_amount = ($item->price - $item->discount) * (($cart->quantity) / 1000) + $total_amount;
                } else {
                    $cart->quantity = APIHelper::getVolume($cart_item["quantity1"], $cart_item["quantity2"]);
                    $total_amount = ($item->price - $item->discount) * (($cart->quantity) / 1000) + $total_amount;
                }

                $cart->item_id = $item->id;
                $cart->price = $item->price;
                $cart->discount = $item->discount;
                $cart->order_id = Order::orderby('created_at', 'desc')->first()->id + 1;
                $cart->save();
                $order->shop_id = $item->shop_id;
                $item->quantity = $item->quantity - $cart->quantity;
                if ($item->quantity < 0) {
                    $quantityAvailible = false;
                }
                $item->save();
            }
            $order->user_id = Auth::user()->id;
            $order->total_amount = $total_amount;
            $order->delivery_address = $request->input('delivery_address');
            $order->status = 'pending';
            if ($quantityAvailible) {

                $result = $order->save();

                return APIHelper::makeAPIResponse(true, "Order Added", null, 200);
            } else {
                $cartItems = CartItem::where('order_id', Order::all()->count() + 1)->with('item')->get();

                foreach ($cartItems as $cartItem) {
                    $item = Item::find($cartItem->item_id);
                    $item->quantity = $cartItem->quantity + $item->quantity;
                    $item->save();
                    $cartItem->delete();
                }

                return APIHelper::makeAPIResponse(false, "Some items are out of stock.Please check the availibility of each item", null, 422);
            }
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

            if($order->status == ('completed' || 'rejected')){
                return APIHelper::makeAPIResponse(true, "order cancellation failed, please contact the shop", null, 404);

            }
            else{
                foreach ($order->cart as $cartItem) {
                    $item = Item::find($cartItem->item_id);
                    $item->quantity = $cartItem->quantity + $item->quantity;
                    $item->save();
                }
                $order->status = "customer cancelled";
                $order->save();
                return APIHelper::makeAPIResponse(true, "order Cancelled", null, 200);
            }


            return APIHelper::makeAPIResponse(true, "order Cancelled", null, 200);
        } catch (\Exception $e) {
            report($e);
            return APIHelper::makeAPIResponse(false, "Service error", null, 500);
        }
    }
}
