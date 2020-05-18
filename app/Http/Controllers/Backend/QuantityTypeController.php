<?php

namespace App\Http\Controllers\Backend;
use App\QuantityType;
use App\Helpers\APIHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\BackendRequest\CreateQuantityTypeRequest;

class QuantityTypeController extends Controller
{
    public function index()
    {
        $quantityTypes = QuantityType::paginate(10);
        return view('backend.pages.quantityTypes.index', ["quantityTypes" => $quantityTypes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.quantityTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateQuantityTypeRequest $request)
    {
        $quantityType = new QuantityType();
        $quantityType->name = $request->input("name");
        $quantityType->unit1 = $request->input("unit1");
        $quantityType->unit2 = $request->input("unit2");

        $result = $quantityType->save();
        if ($result) {
            return redirect()->route('backend.quantityTypes.index')->with(session()->flash('success', 'quantityType Created!'));
        } else {
            return redirect()->route('backend.quantityTypes.index')->with(session()->flash('error', 'Something went wrong!'));
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
        $quantityType = QuantityType::find($id);
        return view('backend.pages.quantityTypes.edit', ["quantityType" => $quantityType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateQuantityTypeRequest $request, $id)
    {
        $quantityType = QuantityType::find($id);
        $quantityType->name = $request->input("name");
        $quantityType->unit1 = $request->input("unit1");
        $quantityType->unit2 = $request->input("unit2");

        $result = $quantityType->save();
        if ($result) {
            return redirect()->route('backend.quantityTypes.index')->with(session()->flash('success', 'quantityType Updated!'));
        } else {
            return redirect()->route('backend.quantityTypes.index')->with(session()->flash('error', 'Something went wrong!'));
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
        $result = QuantityType::find($id)->delete();
        if ($result) {
            return redirect()->route('backend.quantityTypes.index')->with(session()->flash('success', 'quantityType Deleted!'));
        } else {
            return redirect()->route('backend.quantityTypes.index')->with(session()->flash('error', 'Something went wrong!'));
        }
    }
}
