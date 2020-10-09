<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::all();
        return $cart;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cart = Cart::create($request->all());
        $cart->save();
        return $cart;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cart = Cart::where('user_id', $id)->get();
        return $cart;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userid, $productid)
    {
        // $cart = Cart::find($id);
        $cart = Cart::where([['user_id',$userid], ['product_id', $productid]]);
        // $cart->where('id', $id);
        // $cart->color = 'grey';
        // $cart->update([color => $request->input('color')]);
        // $cart->update(['color' => 'green']);
        $cart->update($request->all());
        $cart->save();
        return response()->json($cart); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($userid, $productid)
    {
        $cart = Cart::where([['user_id', $userid], ['product_id', $productid]]);
        $cart->delete();
        return response()->json($cart);
    }
}
