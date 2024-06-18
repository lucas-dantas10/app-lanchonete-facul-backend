<?php

namespace App\Http\Controllers\Orders;

use App\Enums\Orders\StatusOrder;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrdersClientListController
{
    public function __invoke(Request $request): JsonResponse
    {
        $orders = Order::query()
            ->with(["user", "itemOrder.product"])
            ->where("user_id", auth()->id())
            ->where('status_order', 'is not', StatusOrder::ENCERRED->value)
            ->orderBy("token_order", "asc") 
            ->get();

        if ($orders->isEmpty()) {
            return new JsonResponse([
                'message' => 'Não possui nenhum pedido',
                'status' => JsonResponse::HTTP_OK,
            ], JsonResponse::HTTP_OK);
        }

        return new JsonResponse([
            'orders' => $orders,
            'status' => JsonResponse::HTTP_OK,
        ], JsonResponse::HTTP_OK);
    }
}
