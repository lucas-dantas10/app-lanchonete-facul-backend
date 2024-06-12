<?php 

namespace App\Http\Controllers\Orders;

use App\Enums\Orders\StatusOrder;
use App\Models\ItemCart;
use App\Models\ItemOrder;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrdersCreateController 
{
    public function __invoke(Request $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $totalPrice = 0;
            $orderData = [
                "user_id" => auth()->id(),
                "token_order" => strtoupper(str()->random(5)),
                "total_price" => $totalPrice,
                "status_order" => StatusOrder::NOT_PAID->value,
            ];
            $cartItems = ItemCart::where("user_id", auth()->id())
                ->with('product')
                ->get();
            

            if ($cartItems->isEmpty()) {
                return new JsonResponse([
                    "message" => "Não possui items no carrinho!",
                    "status" => JsonResponse::HTTP_BAD_REQUEST,
                ], JsonResponse::HTTP_BAD_REQUEST);
            }
            
            foreach ($cartItems as $cartItem) {
                $price = $cartItem->product->price * $cartItem->quantity;
                $totalPrice += $price; 
            }

            $orderData['total_price'] = $totalPrice;

            $order = Order::create($orderData);

            foreach ($cartItems as $cartItem) {
                $orderItemData = [
                    "product_id" => $cartItem->product->id,
                    "order_id" => $order->id,
                    "quantity" => $cartItem->quantity,
                    "price_unit"=> $cartItem->product->price,
                ];

                ItemOrder::create($orderItemData);
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::critical($exception->getMessage());

            return new JsonResponse([
                "message" => "Erro ao realizar o pedido!",
                "status" => JsonResponse::HTTP_BAD_REQUEST,
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([
            "message" => "Pedido realizado com sucesso!",
            "status" => JsonResponse::HTTP_OK,
        ], JsonResponse::HTTP_OK);
    }
}
