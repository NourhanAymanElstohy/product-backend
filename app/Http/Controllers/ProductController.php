<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProduct;
use App\Http\Requests\UpdateProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function store(StoreProduct $request)
    {
        $path = $request->file('image')->store('public/images');
        $path = str_replace('public/', '', $path);

        $product = Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'image' =>  "/storage/" . $path
        ]);

        return response()->json(['message' => 'Product Created successfully', 'data' => $product], 201);
    }

    public function update(UpdateProduct $request, $id)
    {
        $product = Product::findOrFail($id);
        if (!$product) {
            return response()->json(['message' => 'product is not found'], 404);
        } else {
            $product->update($request->validated());
            if ($request->hasFile('image')) {
                Storage::delete('public/' . $product->getAttributes()['image']);
                $path = $request->file('image')->store('public/images');
                $path = str_replace('public/', '', $path);
                $product->image = "/storage/" . $path;
                $product->save();
            }
            return response()->json(['message' => 'Product Updated successfully', 'data' => $product], 200);
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
