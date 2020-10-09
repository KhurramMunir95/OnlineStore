<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return $product;
        // return view('products',['product'=>$product]);
        
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
        $product = Product::create($request->all());
        $product->save();
        return $product;
        // return Product::create([
        //     'name' => $request['name'],
        //     'price' => $request['price'],
        //     'quantity' => $request['quantity'],
        //     'category_id' => $request['category_id']
        // ]);
        // $product->name = $request->input('name');
        // $product->price = $request->input('price');
        // $product->quantity = $request->input('quantity');
        // $product->category_id = $request->input('category_id');
        // $product->save();
        // return response()->json($product);
        // return redirect('/addproduct');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return $product;          
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $product = Product::find($id);
        $product->where('id', $id);
        // $product->update(['name'=>$request['name'], 'price'=>$request['price']]);
        $product->update($request->all());
        $product->save();
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json($product);

            /* delete by name */
        // $product = new Product;
        // $product->where('name', $name)->delete();
        // return response()->json($product);
    }
}
