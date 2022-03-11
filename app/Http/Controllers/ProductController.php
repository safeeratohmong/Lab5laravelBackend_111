<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = [
            'name' => 'index' ,
            'payload' => Product::all(),
        ];
        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validete([
            "product_name" => 'required|string',
            "product_type" => 'required|integer' ,
            "price" => 'required', 
        ]);

        Product::create([
            "product_name" => $fields["name"],
            "product_type" => $fields["type"],
            "price" => $fields["price"],

        ]);


        $result = [
            'name' => 'store' ,
            'payload' => $request->all(),
        ];
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
            $result = [
                'name' => 'show' ,
                'payload' => Product::where('id',$id)->first(),
            ];
            return $result;
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fields = $request->validate([
            "product_name" => 'required|string',
            "product_type" => 'required|integer' ,
            "price" => 'required',
        ]);


        $product = Product::where("id",$id)->update($request->all());

        $result = [
            'name' => 'update' ,
            'payload' => $request->all(),
        ];
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id)->delete();

        $result = [
            'name' => 'destroy' ,
            'payload' => $product,
        ];
        return $result;
    }
}
