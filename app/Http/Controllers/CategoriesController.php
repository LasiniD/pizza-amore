<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Pizza;
use Illuminate\Support\Facades\pizzaWebsite;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Categories::all();
        return view ('admin.category')->with('categories',$categories);
    }

    public function menu()
    {
        $categories=pizzaWebsite::table('categories')
                                ->select('categories.*','pizza.name as name','pizza.description as description')
                                ->leftjoin('pizza','id','id')
                                ->get();

        return view('menu',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create.createCategory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Categories::create($input);
        return redirect('category')->with('flash_message','Category Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $c_id)
    {
        $categories=Categories::find($c_id);
        return view('admin.view.viewCategory')->with('categories',$categories);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $c_id)
    {
        $categories=Categories::find($c_id);
        return view('admin.update.editCategory')->with('categories',$categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $c_id)
    {
        $categories=Categories::find($c_id);
        $input=$request->all();
        $categories->update($input);
        return redirect('category')->with('flash_message','Category Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $c_id)
    {
        Categories::destroy($c_id);
        return redirect('category')->with('flash_message','Category deleted!');
    }


}
