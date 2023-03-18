<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    /**
     * Display all products with filters (if they were added) with their properties, 40 products per page.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        return ProductResource::collection(
            Product::filter($request->input(Product::PROPERTIES_RELATION_NAME))
                ->with(Product::PROPERTIES_RELATION_NAME)
                ->paginate(40)
        );
    }
}
