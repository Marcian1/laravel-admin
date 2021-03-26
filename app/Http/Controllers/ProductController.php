<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests\ProductCreateRequest;
use App\Http\Resources\ProductResource;
use App\Product;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::paginate();

        return ProductResource::collection($products);
    }

    public function show($id)
    {
        return new ProductResource(Product::find($id));
    }

    public function store(ProductCreateRequest $request)
    {


        $product = Product::create($request->only('title', 'description', 'image', 'price'));

        return response($product, 201);
    }

    public function update(Request $request, $id)
    {

        $product = Product::find($id);

        $product->update($request->only('title', 'description', 'image', 'price'));
        
        return response($product, 202);
    }
    public function destroy($id)
    {

        Product::destroy($id);

        return response(null, 204);
    }
}
