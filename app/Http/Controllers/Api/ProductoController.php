<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class ProductoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Product[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Product::all();
    }


    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Product
     */
    public function show(int $product)    {

        return Product::where('id',$product)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'available' => 'required',
            'status' => 'required'
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->purchase_price = $request->purchase_price;
        $product->sale_price = $request->sale_price;
        $product->available = $request->available;
        $product->productimg = "";
        $product->status = $request->status;
        $product->category_id = $request->category_id;
        $product->available = $request->available;
        $product->created_at = now();
        $product->updated_at = now();

        if ($product->save())
            return response()->json([
            'success' => true,
            'data' => $product->toArray()
        ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Post not added'
            ], 500);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int  $product)
    {


        $post=Product::find($product);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 400);
        }
        $updated = $post->fill($request->all())->save();

        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Post can not be updated'
            ], 500);
    }
}
