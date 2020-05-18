<?php


namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\QuantityType;
use App\Helpers\APIHelper;
use Illuminate\Http\Request;
class QuantityTypeController extends Controller
{
    public function getQuantityType($id)
    {

        try {
            $quantityType = QuantityType::find($id);
            return APIHelper::makeAPIResponse(true, "Quantity Type", $quantityType, 200);
            
        } catch (\Exception $e) {
            report($e);
            return APIHelper::makeAPIResponse(false, "Service error", null, 500);
        }
    }
  
}
