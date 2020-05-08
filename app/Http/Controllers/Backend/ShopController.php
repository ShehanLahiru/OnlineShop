<?php

namespace App\Http\Controllers\Backend;

use App\Shop;
use App\Helpers\APIHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BackendRequest\CreateShopRequest;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::paginate(10);
        return view('backend.pages.shops.index', ["shops" => $shops]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->user_type = 'super_admin') {

            return view('backend.pages.shops.create');
        } else {
            return view('backend.pages.shops.index')->with(session()->flash('error', 'You are not authorized to create a shop'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateShopRequest $request)
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
        if (Auth::user()->user_type == 'super_admin') {
            $shop = Shop::find($id);
            dd(Auth::user()->user_type);
            return view('backend.pages.shops.edit', ["shop" => $shop]);
        } else {
            return view('backend.pages.shops.index')->with(session()->flash('error', 'You are not authorized to edit a shop'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateShopRequest $request, $id)
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
        if (Auth::user()->user_type == 'super_admin') {
            $result = Shop::find($id)->delete();
            if ($result) {
                return redirect()->route('backend.shops.index')->with(session()->flash('success', 'Shop Deleted!'));
            } else {
                return redirect()->route('backend.shops.index')->with(session()->flash('error', 'Something went wrong!'));
            };
        } else {
            return view('backend.pages.shops.index')->with(session()->flash('error', 'You are not authorized to edit a shop'));
        }
    }
}
