<?php

namespace App\Http\Controllers\Orders;

use App\Models\ItemOrder;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrdersListController
{
    public function __invoke(Request $request): JsonResponse
    {
        $orders = Order::query()
            ->with(["user", "itemOrder.product"])
            ->orderBy("token_order","asc")
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
