<?php

namespace App\Http\Controllers\Backend;

use App\Item;
// use App\Http\Requests\CMS\RiddleCreateRequest;
// use App\Http\Requests\CMS\RiddleUpdateRequest;
use App\Shop;
use App\Category;
use App\ItemCategory;
use App\Helpers\APIHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BackendRequest\CreateItemRequest;


class ItemController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if($user->user_type==('super_admin')){
            $items = Item::all();
        }
        else{
            $items = Item::all()->where('shop_id',$user->shop_id);
        }
        return view('backend.pages.items.index',["items"=>$items,]);

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

        if($user->user_type==('super_admin')){
            $shops = Shop::all();
        }
        else{
            $shops = $user->shop_id;
        }
        return view('backend.pages.items.create',["categories"=>$categories,"shops"=>$shops,]);
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
        $item->quantity = $request->input("quantity");
        $item->quantity_type = $request->input("quantity_type");
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
        $item = Item::find($id);
        $user = Auth::user();
        $categories = ItemCategory::all();

        if($user->user_type==('super_admin')){
            $shops = Shop::all();
        }
        else{
            $shops = $user->shop_id;
        }
        return view('backend.pages.items.edit',["categories"=>$categories,"shops"=>$shops,"item"=>$item]);
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
        $item->quantity = $request->input("quantity");
        $item->quantity_type = $request->input("quantity_type");
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
}