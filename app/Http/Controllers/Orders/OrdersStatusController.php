<?php 

namespace App\Http\Controllers\Orders;

use App\Enums\Orders\StatusOrder;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrdersStatusController
{
    public function __invoke(Request $request, int $id): JsonResponse
    {
        $requestValidated = $request->validate([
            "status_type" => ["required", Rule::enum(StatusOrder::class)]
        ]);

        $order = Order::where("id", $id)
            ->where('id', $id);

        $order->update([
            "status_order" => $requestValidated["status_type"],
            "updated_at" => now()
        ]);

        return new JsonResponse([
            "message" => "Status alterado!",
            "status" => JsonResponse::HTTP_OK 
        ], JsonResponse::HTTP_OK);
    }
}
