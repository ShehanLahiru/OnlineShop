<?php

namespace App\Http\Controllers\API;
use App\Item;
use App\CartItem;
use App\CategoryType;
use App\Helpers\APIHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{

    public function addToCart(Request $request)
    {
        try {
            $cart = new CartItem();
            $item = Item::find($request->input('item_id'));
           $cart->user_id = Auth::user()->id;
           $cart->shop_id = $item->shop_id;
            $cart->item_id = $request->input('item_id');

            if ($item->quantityType->name == 'piece') {
                $cart->quantity = $request->quantity1;
            } elseif ($item->quantityType->name == 'loose') {
                $cart->quantity = APIHelper::getWeight($request->quantity1,$request->quantity2);
            } else {
                $cart->quantity = APIHelper::getVolume($request->quantity1,$request->quantity2);;

            }
            $cart->save();
            return APIHelper::makeAPIResponse(true, "Item Added",null, 200);
        } catch (\Exception $e) {
            report($e);
            return APIHelper::makeAPIResponse(false, "Service error", null, 500);
        }

    }

    public function getAllCartItems($id)
    {
        try {
            $user_id = Auth::user()->id;
            $carts = CartItem::with('item')->where('shop_id',$id)->where('user_id',$user_id)->where('order_id',Null)->get();

           return APIHelper::makeAPIResponse(true, "All Items",$carts, 200);
       }
       catch (\Exception $e) {
           report($e);
           return APIHelper::makeAPIResponse(false, "Service error", null, 500);
       }

    }

    public function getCartItemById($id)
    {
        try {
            $cart = CartItem::find($id)->with('item.quantityType','item.itemCategory')->get();

           return APIHelper::makeAPIResponse(true, "Item Found",$cart, 200);
       }
       catch (\Exception $e) {
           report($e);
           return APIHelper::makeAPIResponse(false, "Service error", null, 500);
       }

    }
    public function removeItem($id)
    {
        try {
            $cart = CartItem::find($id);
            $cart->delete();

           return APIHelper::makeAPIResponse(true, "Item Removed",null, 200);
       }
       catch (\Exception $e) {
           report($e);
           return APIHelper::makeAPIResponse(false, "Service error", null, 500);
       }

    }
}
