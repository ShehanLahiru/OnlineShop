<?php

namespace App\Http\Controllers\Backend;

use App\Shop;
use App\User;
use App\Helpers\APIHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::with('shop')->where('user_type', 'admin')->paginate(10);
        return view('backend.pages.users.index', ["users" => $users]);
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if (Auth::user()->user_type == 'super_admin') {
            $shops = Shop::all();
            return view('backend.pages.users.create', ["shops" => $shops]);
        } else {
            return redirect()->route('backend.users.index')->with(session()->flash('error', 'You are not authorized!'));
        }
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $user = new User();
        $user->name = $request->input("name");
        $user->email =  $request->input("email");
        $user->user_type = "admin";
        $user->shop_id =  $request->input("shop_id");
        $user->password = bcrypt($request->input("password"));
        $result = $user->save();
        if ($result) {
            return redirect()->route('backend.users.index')->with(session()->flash('success', 'user Created!'));
        } else {
            return redirect()->route('backend.users.index')->with(session()->flash('error', 'Something went wrong!'));
        }
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        if (Auth::user()->user_type == 'super_admin') {
            $user = User::find($id);
            $shops = Shop::all();
            return view('backend.pages.users.edit', ["user" => $user], ["shops" => $shops]);
        } else {
            return redirect()->route('backend.users.index')->with(session()->flash('error', 'You are not authorized!'));
        }
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input("name");
        $user->email =  $request->input("email");
        $user->shop_id =  $request->input("shop_id");
        $result = $user->save();
        if ($result) {
            return redirect()->route('backend.users.index')->with(session()->flash('success', 'user Updated!'));
        } else {
            return redirect()->route('backend.users.index')->with(session()->flash('error', 'Something went wrong!'));
        }
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if (Auth::user()->user_type == 'super_admin') {
            $user = User::find($id);
            $result = $user->delete();
        } else {
            return redirect()->route('backend.users.index')->with(session()->flash('error', 'You are not authorized!'));
        }

        if ($result) {
            return redirect()->route('backend.users.index')->with(session()->flash('success', 'User Deleted!'));
        } else {
            return redirect()->route('backend.users.index')->with(session()->flash('error', 'Something went wrong!'));
        }
    }
    public function getcustomers()
    {
        $users = User::where('user_type', 'user')->paginate(10);
        return view('backend.pages.customers.index', ["users" => $users]);
    }
}
