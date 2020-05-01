<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\APIHelper;
// use App\Http\Requests\CMS\RiddleCreateRequest;
// use App\Http\Requests\CMS\RiddleUpdateRequest;
use App\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::paginate(10);
        return view('backend.pages.shops.index',["shops"=>$shops]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.shops.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shop = new Shop();
        $shop->name = $request->input("name");
        $shop->address = $request->input("address");
        $shop->contact_no = $request->input("contact_no");

        $result = $shop->save();
        if ($result) {
            return redirect()->route('backend.shops.index')->with(session()->flash('success', 'Shop Created!'));
        } else {
            return redirect()->route('backend.shops.index')->with(session()->flash('error', 'Something went wrong!'));
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
        $shop = Shop::find($id);
        return view('backend.pages.shops.edit',["shop"=>$shop]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $shop = Shop::find($id);
        $shop->name = $request->input("name");
        $shop->address = $request->input("address");
        $shop->contact_no = $request->input("contact_no");

        $result = $shop->save();
        if ($result) {
            return redirect()->route('backend.shops.index')->with(session()->flash('success', 'Shop Updated!'));
        } else {
            return redirect()->route('backend.shops.index')->with(session()->flash('error', 'Something went wrong!'));
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
        $result = Shop::find($id)->delete();
        if ($result) {
            return redirect()->route('backend.shops.index')->with(session()->flash('success', 'Shop Deleted!'));
        } else {
            return redirect()->route('backend.shops.index')->with(session()->flash('error', 'Something went wrong!'));
        }
    }
}
