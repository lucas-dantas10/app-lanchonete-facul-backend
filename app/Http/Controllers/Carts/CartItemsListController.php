<?php

namespace App\Http\Controllers\Carts;

use App\Models\ItemCart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartItemsListController
{
    public function __invoke(Request $request): JsonResponse
    {
        $cartItems = ItemCart::with("product")
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            return new JsonResponse([
                'message' => 'Não possui lanches no carrinho!',
                'status' => JsonResponse::HTTP_OK,
            ],  JsonResponse::HTTP_OK);
        }

        return new JsonResponse([
            'cartItems' => $cartItems,
            'status' => JsonResponse::HTTP_OK,
        ],  JsonResponse::HTTP_OK);
    }
}
