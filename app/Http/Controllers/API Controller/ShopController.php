<?php

namespace App\Http\Controllers\APIController;
use App\Http\Controllers\Controller;
use App\Shop;
use App\Helpers\APIHelper;
use Illuminate\Http\Request;

class ShopController extends Controller
{

    public function getAllShop()
    {
        try {
             $shop = Shop::all();

            return APIHelper::makeAPIResponse(true, "All Shops",$shop, 200);
        }
        catch (\Exception $e) {
            report($e);
            return APIHelper::makeAPIResponse(false, "Service error", null, 500);
        }
    }

    public function getShopById($id)
    {
        try {
             $shop = Shop::find($id);

            return APIHelper::makeAPIResponse(true, "Shop Found",$shop, 200);
        }
        catch (\Exception $e) {
            report($e);
            return APIHelper::makeAPIResponse(false, "Service error", null, 500);
        }
    }

}
