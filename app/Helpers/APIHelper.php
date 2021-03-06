<?php

namespace App\Helpers;

use App\Item;
use App\Shop;
use App\User;
use App\Order;
use App\ItemCategory;
use App\QuantityType;
use http\Env\Request;
use Image;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;


class APIHelper

{

    public static function makeAPIResponse($status = true, $message = "Done", $data = null, $status_code = 200)
    {
        $response = [
            "success" => $status,
            "message" => $message,
            "data" => $data,

        ];
        if ($data != null || is_array($data)) {
            $response["data"] = $data;
        }
        return response()->json($response, $status_code);
    }


    public static function errorsResponse($errors)
    {
        $error_data = [];
        foreach ($errors as $x => $x_value) {
            $data['source'] = $x;
            foreach ($x_value as $value) {
                if (is_array($value)) {
                    $data['detail'] = $value[1];
                } else {
                    $data['detail'] = $value;
                }
            }
            $error_data[] = $data;
        }
        $response = [
            "success" => false,
            "message" => "Validation Errors",
            "errors" => $error_data
        ];
        return $response;
    }

    // public static function uploadMultipleFileToStorage($images, $path,$id)
    // {
    //     if(isset($images) && $images !== null){
    //         foreach($images as $key => $image){
    //             $disk = Storage::disk('local');
    //             $result = $disk->putFileAs($path, $image, md5(time()+ rand()). ($image->getClientOriginalExtension() !== null ? '.'.$image->getClientOriginalExtension() : ''));
    //             if ($result) {
    //                 $url = $disk->url($result);
    //                 $reSizePath = public_path(''.$url);
    //                 $uploaded_file = Image::make($reSizePath)->resize(100, 100, function($constraint) {
    //                     $constraint->aspectRatio();
    //                 });
    //                 $uploaded_file->save($reSizePath);

    //                 $image = EquipmentImage::updateOrCreate(
    //                     ['equ_id'=>$id,'image_name'=>$key],
    //                     ['image_url' =>  $url]
    //                 );;

    //             }
    //         }
    //     }

    // }

    public static function uploadFileToStorage($uploaded_file, $path)
    {
        if(isset($uploaded_file) && $uploaded_file !== null){
            $disk = Storage::disk('local');
            $result = $disk->putFileAs($path, $uploaded_file, md5(time()). ($uploaded_file->getClientOriginalExtension() !== null ? '.'.$uploaded_file->getClientOriginalExtension() : ''));
            if ($result) {
                $url = $disk->url($result);
                $reSizePath = public_path(''.$url);
                $uploaded_file = Image::make($reSizePath)->resize(200, 200, function($constraint) {
                    $constraint->aspectRatio();
                });
                $uploaded_file->save($reSizePath);
                return $url;

            } else {
                $url = null;
            }
        }
        return null;
    }

    public static function getWeight($kg,$g){

        $quantity = ($kg * 1000) + $g;
        return $quantity;
    }
    public static function getKgFromWeight($kg){

        $quantity = (int)($kg/1000);
        return $quantity;
    }
    public static function getGramFromWeight($g){

        $quantity = ($g % 1000);
        return $quantity;
    }

    public static function getQuantity($qty){

        $kg = APIHelper::getKgFromWeight($qty);
        $g =  APIHelper::getGramFromWeight($qty);
        $quantity = $kg."Kg"." ".$g."g";

        return $quantity;
    }
    public static function getVolume($L,$Ml){

        $quantity = ($L * 1000) + $Ml;
        return $quantity;
    }
    public static function getLFromVolume($l){

        $quantity = (int)($l/1000);
        return $quantity;
    }
    public static function getMlFromVolume($ml){

        $quantity = ($ml % 1000);
        return $quantity;
    }
    public static function getVolumeQuantity($qty){

        $l = APIHelper::getLFromVolume($qty);
        $ml =  APIHelper::getMlFromVolume($qty);
        $quantity = $l."L"." ".$ml."Ml";

        return $quantity;
    }




}
