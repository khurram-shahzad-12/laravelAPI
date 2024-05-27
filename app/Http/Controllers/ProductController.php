<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function createproduct(){
        $data = Product::all();
        return response()->json([
            'data'=>$data,
        ]);

    }

    public function postproducts(Request $request){
        // dd($request->name);
        $data = $request->validate([
            'name'=>'required|string|unique:products',
            'price'=>'required|numeric',
            'discount'=>'numeric|required',
            'stock'=>'integer|required',
        ]);
        // dd($data);
        Product::create($data);
        return response()->json([
            'name'=>'hellow',
            'status'=>200,
        ]);
    }

    public function deleteproduct(Request $request){
        $data = $request->validate([
            'id'=>'integer | required',
        ]);
        $product_id = $data['id'];
        $result = Product :: find($product_id);

        if($result){
            $result->delete();
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'product not found',
            ]);
        }
        return response()->json([
            'status'=>200,
            'message'=>'product deleted successfully',
        ]);
    }

    public function getsingleproduct(Request $request){
        $data = $request->validate([
            'id' =>'integer | required',
        ]);
        $product_id = $data['id'];
        $result = Product::find($product_id);
        if($result){
            return $result;
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'product not found',
            ]);
        }

    }

    public function updateproduct(Request $request){
        $data = $request->validate([
            'id'=>'required | integer',
            'name'=>'string',
            'price'=>'numeric',
            'discount'=>'numeric',
            'stock'=>'integer',
        ]);
        $product_id = $data['id'];
        $result = Product::find($product_id);
        if($result){
            $result->name = isset($data['name'])?$data['name']:$result->name;
            $result->price = isset($data['price'])?$data['price']:$result->price;
            $result->discount = isset($data['discount'])?$data['discount']:$result->discount;
            $result->stock = isset($data['stock']) ? $data['stock'] : $result->stock;

            $result->save();
            return response()->json([
                'status'=>200,
                'message'=>'product save successfully',
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'product does not exist',
            ]);
        }
    }
}
