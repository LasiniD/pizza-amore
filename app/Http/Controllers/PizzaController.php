<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza;

class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pizza=Pizza::all();
        return view ('admin.pizza')->with('pizza',$pizza);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create.createPizza');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Pizza::create($input);
        return redirect('pizza')->with('flash_message','Pizza Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pizza=Pizza::find($id);
        return view('admin.view.viewPizza')->with('pizza',$pizza);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pizza=Pizza::find($id);
        return view('admin.update.editPizza')->with('pizza',$pizza);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pizza=Pizza::find($id);
        $input=$request->all();
        $pizza->update($input);
        return redirect('pizza')->with('flash_message','Pizza Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Pizza::destroy($id);
        return redirect('pizza')->with('flash_message','Pizza deleted!');
    }
}
