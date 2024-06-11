<?php

namespace App\Http\Controllers\Orders;

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrdersListController
{
    public function __invoke(Request $request): JsonResponse
    {
        $user = $request->user();

        $orders = Order::where("user_id", $user->id)
            ->paginate(10);

        if (empty($orders->items())) {
            return new JsonResponse([
                'message' => 'Não possui nenhum pedido',
                'status' => JsonResponse::HTTP_OK,
            ]);
        }

        return new JsonResponse([
            'orders' => $orders,
            'status' => JsonResponse::HTTP_OK,
        ]);
    }
}
