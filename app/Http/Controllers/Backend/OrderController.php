<?php

namespace App\Http\Controllers\Backend;

use App\Item;
use App\Shop;
use App\User;
use App\Order;
use App\CartItem;
use App\Category;
use App\ItemCategory;
use App\Helpers\APIHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        if ($user->user_type == ('super_admin')) {
            $orders = Order::with('user')->orderBy('created_at','desc')->get();
        } else {
            $orders = Order::where('shop_id', $user->shop_id)->orderBy('created_at','desc')->get();
        }
        return view('backend.pages.orders.index', ["orders" => $orders,]);
    }
    public function show($id)
    {
        $order = Order::where('id',$id)->with('user')->first();
        $cartItem = CartItem::where('order_id',$id)->with('item')->get();
        return view('backend.pages.orders.show', ["order" => $order,"cartItem" => $cartItem]);

    }

    public function changeOrderStatus(Request $request,$id)
    {
        $order = Order::find($id);
        $order->status = 'received';
        $result = $order->save();

        if ($result) {
            return redirect()->route('backend.orders.index')->with(session()->flash('success', 'Order Updated!'));
        } else {
            return redirect()->route('backend.orders.index')->with(session()->flash('error', 'Something went wrong!'));
        }

    }
    public function changeStatus(Request $request,$id)
    {
        $order = Order::find($id);
        $order->status = 'completed';
        $result = $order->save();

        if ($result) {
            return redirect()->route('backend.orders.show',$id)->with(session()->flash('success', 'Order Updated!'));
        } else {
            return redirect()->route('backend.orders.show',$id)->with(session()->flash('error', 'Something went wrong!'));
        }

    }
    public function removeItem($id)
    {
        $cartItem = CartItem::find($id);
        $order = Order::where('id', $cartItem->order_id)->first();
        $order->total_amount = $order->total_amount - (($cartItem->price-$cartItem->discount) * $cartItem->quantity);
        $cartItem->delete();
        $result = $order->save();

        if ($result) {
            return redirect()->route('backend.orders.show',$order->id)->with(session()->flash('success', 'Order Updated!'));
        } else {
            return redirect()->route('backend.orders.show',$order->id)->with(session()->flash('error', 'Something went wrong!'));
        }

    }
}
