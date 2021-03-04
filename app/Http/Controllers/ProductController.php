<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products, 200);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        if (isset($product)) {
            return response()->json($product, 200);
        } else {
            return response()->json('Product Not found', 404);
        }
    }

    public function store(Request $request)
    {
        $product = Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/images');
            $path = str_replace('public/', '', $path);
            $product->image = $path;
        }

        return response()->json(['message' => 'Product Created successfully'], 200);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if (!$product) {
            return response()->json(['message' => 'product is not found'], 404);
        } else {
            $product->update($request);
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('public/images');
                $path = str_replace('public/', '', $path);
                $product->image = $path;
            }
            return response()->json(['message' => 'Product Updated successfully'], 200);
        }
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if (!$product) {
            return response()->json(['message' => 'product is not found'], 404);
        } else {
            $product->delete();
            return response()->json(['message' => 'Product deleted successfuly'], 200);
        }
    }
}
