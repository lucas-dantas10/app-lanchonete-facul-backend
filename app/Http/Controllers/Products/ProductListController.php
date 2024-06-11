<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductListController
{
    public function __invoke(Request $request): JsonResponse
    {
        $products = Product::orderBy("id","desc")->get();

        if ($products->isEmpty()) {
            return new JsonResponse([
                'message' => 'Não possui lanches!',
                'status' => JsonResponse::HTTP_OK,
            ], JsonResponse::HTTP_OK);
        }

        return new JsonResponse([
            'products' => $products,
            'status' => JsonResponse::HTTP_OK,
        ], JsonResponse::HTTP_OK);
    }
}
