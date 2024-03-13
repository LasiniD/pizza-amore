<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menus=Menu::all();
        return view('pages.menu',compact('menus'));
    }

    public function logged()
    {
        $menus=Menu::all();
        return view('pages.menuLogged',compact('menus'));
    }

    public function cart()
    {
        return view('cart');
    }

    public function addItemToCart($id)
    {
        $menus=Menu::findOrFail($id);
        $cart=session()->get('cart',[]);
        if(isset($cart[$id])){
            $cart[$id]['quantity']++;
        }else{
            $cart[$id]=[
                "name"=>$menus->name,
                "quantity"=>1,
                "price"=>$menus->price,
                "size"=>$menus->size
            ];
        }
        session()->put('cart',$cart);
        return redirect()->back()->with('success','Menu item added to cart!');
    }

    public function deleteItem(Request $request)
    {
        if($request->id){
            $cart=session()->get('cart');
            if(isset($cart[$request->id])){
                unset($cart[$request->id]);
                session()->put('cart',$cart);
            }
            session()->flash('success','Item successfully deleted!');
        }
    }

    public function addQuantity(Request $request)
    {
        if($request->id)
        $cart=session()->get('cart');
        if(isset($cart[$request->id])){
            $cart[$request->id]['quantity']++;
            session()->put('cart',$cart);
        }
        session()->flash('success','Quantity successfully added!');
    }

    public function removeQuantity(Request $request)
    {
        if($request->id)
        $cart=session()->get('cart');

        if ($cart[$request->id]['quantity'] < 2) {
            return redirect()->route('delete.cart.item', $request->id);
        }else if(isset($cart[$request->id])){
            $cart[$request->id]['quantity']--;
            session()->put('cart',$cart);
        }
        session()->flash('success','Quantity successfully deleted!');

        //return redirect()->back()->with('success','Quantity successfully updated!');
    }
}
