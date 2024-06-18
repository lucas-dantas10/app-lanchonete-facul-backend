<?php

namespace App\Http\Controllers\Carts;

use App\Models\ItemCart;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartItemsCreateController
{
    public function __invoke(Request $request): JsonResponse
    {
        $requestValidated = $request->validate([
            "product_id"=> ["required", "numeric"],
            "quantity" => ["required", "numeric"],
        ]);

        $product = Product::where("id", $requestValidated["product_id"])->first();

        if (empty($product)) {
            return new JsonResponse([
                "message" => "Este produto não existe!",
                "status" => JsonResponse::HTTP_BAD_REQUEST,
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        $cartItem = ItemCart::where("product_id", $requestValidated['product_id'])
            ->where('user_id', auth()->id())
            ->first();

        if (!empty($cartItem)) {
            return new JsonResponse([
                "message" => "Já possui este item no carrinho!",
                "status" => JsonResponse::HTTP_BAD_REQUEST,
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        $requestValidated["user_id"] = auth()->id();
        $requestValidated["price_unit"] = $product->price;

        $cartItem = ItemCart::create($requestValidated);

        $cartItems = ItemCart::with("product")
            ->where('user_id', auth()->id())
            ->get();

        return new JsonResponse([
            "message" => "Item adicionado ao carrinho!",
            "cart_item" => $cartItems,
            "status" => JsonResponse::HTTP_CREATED,
        ], JsonResponse::HTTP_CREATED);
    }
}
