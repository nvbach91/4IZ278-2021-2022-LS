<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Resources\ProductsResource;
use App\Http\Requests\ProductsRequest;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use App\Custom\Features;
use JetBrains\PhpStorm\Pure;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ProductsResource::collection(Product::all());
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return ProductsResource
     */
    #[Pure] public function show(Product $product): ProductsResource
    {
        return new ProductsResource($product);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductsRequest $request
     * @return ProductsResource
     */
    public function store(ProductsRequest $request): ProductsResource
    {
        $product = Product::create([
           'product_name' => $request->input("product_name"),
           'price' => $request->input("price"),
           'color' => $request->input("color"),
           'category_id' => $request->input("category_id"),
           'description' => $request->input("description"),
        ]);
        $pivotColumns = ["size_id", "remaining_quantity"];

        $pivotData = Features::preparePivotData($request->input("sizes"), $pivotColumns);

        $product->size()->attach($pivotData);

        return new ProductsResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Product $product
     * @return ProductsResource
     */
    public function update(Product $product): ProductsResource
    {
        $product->update(request()->all());
        return new ProductsResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Response
     */
    public function destroy(Product $product): Response
    {
        $product->delete();
        return response(null, 204);
    }
}
