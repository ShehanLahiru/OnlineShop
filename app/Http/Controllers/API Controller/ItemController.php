<?php

namespace App\Http\Controllers\APIController;
use App\Item;
use App\CategoryType;
use App\Helpers\APIHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function getAllItem($id)
    {
       try {
             $item = Item::with('itemCategory:id,name','shop:id,name')->where('shop_id',$id)->get();

            return APIHelper::makeAPIResponse(true, "All Items",$item, 200);
        }
        catch (\Exception $e) {
            report($e);
            return APIHelper::makeAPIResponse(false, "Service error", null, 500);
        }
    }

    public function getItemById($id)
    {
        try {
             $item = Item::with('itemCategory:id,name')->find($id);

            return APIHelper::makeAPIResponse(true, "Item Found",$item, 200);
        }
        catch (\Exception $e) {
            report($e);
            return APIHelper::makeAPIResponse(false, "Service error", null, 500);
        }
    }
}
