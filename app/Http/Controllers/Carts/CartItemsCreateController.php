<?php

namespace App\Http\Controllers\Carts;

use App\Models\ItemCart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartItemsCreateController
{
    public function __invoke(Request $request): JsonResponse
    {
        $requestValidated = $request->validate([
            "product_id"=> ["required", "numeric"],
            "quantity" => ["required", "numeric"],
            "price_unit" => ["required", "numeric"],
        ]);

        $cartItem = ItemCart::where("product_id", $requestValidated['product_id'])
            ->where('user_id', auth()->id())
            ->first();

        if (empty($cartItem)) {
            return new JsonResponse([
                "message" => "Já possui este item no carrinho!",
                "status" => JsonResponse::HTTP_BAD_REQUEST,
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        $requestValidated["user_id"] = auth()->id();

        $cartItem = ItemCart::create($requestValidated);

        return new JsonResponse([
            "message" => "Item adicionado ao carrinho!",
            "status" => JsonResponse::HTTP_CREATED,
        ], JsonResponse::HTTP_CREATED);
    }
}
