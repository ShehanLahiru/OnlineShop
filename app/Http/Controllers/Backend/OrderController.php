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
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        if ($user->user_type == ('super_admin')) {
            $orders = Order::with('user')->orderBy('created_at','desc')->paginate(10);
        } else {
            $orders = Order::where('shop_id', $user->shop_id)->orderBy('created_at','desc')->paginate(10);
        }
        return view('backend.pages.orders.index', ["orders" => $orders,]);
    }
    public function show($id)
    {
        $order = Order::where('id',$id)->with('user')->first();
        $cartItems = CartItem::where('order_id',$id)->with('item.quantityType')->get();
        foreach( $cartItems as $cartItem){
            if($cartItem->item->quantityType->name == "loose"){
                $cartItem->amount = ($cartItem->price - $cartItem->discount) * ($cartItem->quantity/1000);
                $cartItem->quantity =  APIHelper::getQuantity( $cartItem->quantity);

            }
            elseif($cartItem->item->quantityType->name == "liquide"){
                $cartItem->amount = ($cartItem->price - $cartItem->discount) * ($cartItem->quantity/1000);
                $cartItem->quantity =  APIHelper::getVolumeQuantity( $cartItem->quantity);
            }
            else{
                $cartItem->amount = ($cartItem->price - $cartItem->discount) * ($cartItem->quantity);
            }
        }

        return view('backend.pages.orders.show', ["order" => $order,"cartItem" => $cartItems]);

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
    public function changeStatus(Request $request,$id)//reject remove item
    {
        $order = Order::find($id);
        $order->status = $request->input('status');
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
    public function orderSearch(Request $request){
        $search = $request->input('search');
        $filter = $request->input('filter');
        $user = Auth::user();
        if ($user->user_type == ('super_admin')){
           $orders = Order::orWhereHas('user', function (Builder $query) use($search) {
               $query->where('name', 'like', '%' . strtolower($search) . '%');
           })->where('status','like','%'  . strtolower($filter) . '%')->orderBy('created_at','desc')->paginate(10);

        }
        else{
           $orders = Order::orWhereHas('user', function (Builder $query) use($search) {
               $query->where('name', 'like', '%' . strtolower($search) . '%');
           })->where('status','like','%'  . strtolower($filter) . '%')->where('shop_id',$user->shop_id)->orderBy('created_at','desc')->paginate(10);
        }

       return view('backend.pages.orders.index', ["orders" => $orders,]);
   }

   public function getTodayOreder()
    {

        $user = Auth::user();
        $date = carbon::now()->format('Y-m-d');

        if ($user->user_type == ('super_admin')) {
            $orders = Order::with('user')->where(DB::raw('DATE(`created_at`)'),$date)->orderBy('created_at','desc')->paginate(10);
        } else {
            $orders = Order::with('user')->where(DB::raw('DATE(`created_at`)'),$date)->where('shop_id', $user->shop_id)->orderBy('created_at','desc')->paginate(10);
        }
        return view('backend.pages.orders.index', ["orders" => $orders,]);
    }
}
