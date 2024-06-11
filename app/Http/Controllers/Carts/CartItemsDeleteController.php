<?php

namespace App\Http\Controllers\Carts;

use App\Models\ItemCart;
use Exception;
use Illuminate\Http\JsonResponse;

class CartItemsDeleteController
{
    public function __invoke(int $id): JsonResponse
    {
        try {
            $cartItem = ItemCart::where('user_id', auth()->id())
                ->where('id', $id)
                ->delete();

            if (empty($cartItem)) {
                return new JsonResponse([
                    'messate' => 'Item não existe!',
                    'status' => JsonResponse::HTTP_BAD_REQUEST,
                ],  JsonResponse::HTTP_BAD_REQUEST);
            }
        } catch (Exception $exception) {
            return new JsonResponse([
                "message" => "Erro!", 
                "status" => $exception->getCode()
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([
            'messate' => 'Item deletado!',
            'status' => JsonResponse::HTTP_OK,
        ],  JsonResponse::HTTP_OK);
    }
}
