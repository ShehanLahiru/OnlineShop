<?php

namespace App\Http\Controllers\Backend;

use App\Item;
use App\Shop;
use App\Category;
use App\ItemCategory;
use App\QuantityType;
use App\Helpers\APIHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\BackendRequest\CreateItemRequest;


class ItemController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->user_type == ('super_admin')) {
            $items = Item::with('quantityType')->paginate(10);
            foreach($items as $item){
                if($item->quantityType->name == 'loose'){
                    $item->quantity = APIHelper::getQuantity($item->quantity);
                }
                elseif($item->quantityType->name == 'liquide'){
                    $item->quantity = APIHelper::getVolumeQuantity($item->quantity);
                }
            }
        } else {
            $items = Item::where('shop_id', $user->shop_id)->with('quantityType')->paginate(10);
            foreach($items as $item){
                if($item->quantityType->name == 'loose'){
                    $item->quantity = APIHelper::getQuantity($item->quantity);
                }
                elseif($item->quantityType->name == 'liquide'){
                    $item->quantity = APIHelper::getVolumeQuantity($item->quantity);
                }
            }
        }
        return view('backend.pages.items.index', ["items" => $items,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $categories = ItemCategory::all();
        $quantityTypes = QuantityType::all();

        if ($user->user_type == ('super_admin')) {
            $shops = Shop::all();
        } else {
            $shops = Shop::where('id',$user->shop_id)->get();
        }
        return view('backend.pages.items.create', ["categories" => $categories, "shops" => $shops,"quantityTypes" => $quantityTypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateItemRequest $request)
    {
        $item = new Item();
        $item->name = $request->input("name");
        $item->description = $request->input("description");
        $item->category_id = $request->input("category_id");
        $item->shop_id = $request->input("shop_id");
        $item->price = $request->input("price");
        $item->quantity_type_id = $request->input("quantity_type");
        $quantity_type = QuantityType::find($item->quantity_type_id);
        if($quantity_type->name == "piece"){
            $item->quantity = $request->input("quantityPiece");
        }
        elseif($quantity_type->name == 'loose'){
            $item->quantity = APIHelper::getWeight($request->input("quantityKg"),$request->input("quantityg"));
        }
        else{
            $item->quantity = APIHelper::getVolume($request->input("quantityL"),$request->input("quantityMl"));
        }
        $item->discount = $request->input("discount");
        if ($request->hasFile('image')) {

            $url = APIHelper::uploadFileToStorage($request->file('image'), 'public/common_media');
            $item->image_url = $url;
        }

        $result = $item->save();
        if ($result) {
            return redirect()->route('backend.items.index')->with(session()->flash('success', 'item Created!'));
        } else {
            return redirect()->route('backend.items.index')->with(session()->flash('error', 'Something went wrong!'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::with('quantityType')->find($id);
        $user = Auth::user();
        $categories = ItemCategory::all();
        $quantityTypes = QuantityType::all();
        if($item->quantityType->name =="piece"){
            $item->quantityPiece = $item->quantity;
        }
        elseif($item->quantityType->name =="loose"){
            $item->quantityKg = APIHelper::getKgFromWeight($item->quantity);
            $item->quantityg = APIHelper::getGramFromWeight($item->quantity);
        }
        else{   
            $item->quantityL = APIHelper::getLFromVolume($item->quantity);
            $item->quantityMl = APIHelper::getMlFromVolume($item->quantity);
        }


        if ($user->user_type == ('super_admin')) {
            $shops = Shop::all();
        } else {
            $shops = Shop::where('id',$user->shop_id)->get();
        }
        return view('backend.pages.items.edit', ["categories" => $categories, "shops" => $shops, "item" => $item, "quantityTypes" => $quantityTypes]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateItemRequest $request, $id)
    {
        $item = Item::find($id);
        $item->name = $request->input("name");
        $item->description = $request->input("description");
        $item->category_id = $request->input("category_id");
        $item->shop_id = $request->input("shop_id");
        $item->price = $request->input("price");
        $item->quantity_type_id = $request->input("quantity_type");
        $quantity_type = QuantityType::find($item->quantity_type_id);
        if($quantity_type->name == "piece"){
            $item->quantity = $request->input("quantityPiece");
        }
        elseif($quantity_type->name == 'loose'){
            $item->quantity = APIHelper::getWeight($request->input("quantityKg"),$request->input("quantityg"));
        }
        else{
            $item->quantity = APIHelper::getVolume($request->input("quantityL"),$request->input("quantityMl"));
        }
        $item->discount = $request->input("discount");
        if ($request->hasFile('image')) {

            $url = APIHelper::uploadFileToStorage($request->file('image'), 'public/common_media');
            $item->image_url = $url;
        }
        $result = $item->save();
        if ($result) {
            return redirect()->route('backend.items.index')->with(session()->flash('success', 'item Updated!'));
        } else {
            return redirect()->route('backend.items.index')->with(session()->flash('error', 'Something went wrong!'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Item::find($id)->delete();
        if ($result) {
            return redirect()->route('backend.items.index')->with(session()->flash('success', 'Item Deleted!'));
        } else {
            return redirect()->route('backend.items.index')->with(session()->flash('error', 'Something went wrong!'));
        }
    }
    public function itemSearch(Request $request){
         $search = $request->input('search');
         $user = Auth::user();
         if ($user->user_type == ('super_admin')){
            $items = Item::orWhereHas('itemCategory', function (Builder $query) use($search) {
                $query->where('name', 'like', '%' . strtolower($search) . '%');
            })->orWhere('name', 'like', '%' . strtolower($search) . '%')->paginate(10);

         }
         else{
            $items = Item::where('shop_id',$user->shop_id)->orWhereHas('itemCategory', function (Builder $query) use($search) {
                $query->where('name', 'like', '%' . strtolower($search) . '%');
            })->orWhere('name', 'like', '%' . strtolower($search) . '%')->paginate(10);
         }


        foreach($items as $item){
            if($item->quantity_type == 'loose'){
                $item->quantity = APIHelper::getQuantity($item->quantity);
            }
            elseif($item->quantity_type == 'liquide'){
                $item->quantity = APIHelper::getVolumeQuantity($item->quantity);
            }
        }
        return view('backend.pages.items.index', ["items" => $items,]);
    }
}
