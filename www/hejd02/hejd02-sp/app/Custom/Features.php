<?php

namespace App\Custom;
use App\Models\EmailCollection;
use App\Models\Order;
use App\Models\ProductSize;

class Features
{
    public static function emailCollection($email): bool
    {
        $emailCollection = new EmailCollection();
        if(filter_var($email, FILTER_VALIDATE_EMAIL) && !$emailCollection::where('email', '=', $email)->first()){
            $emailCollection->email  = $email;
            return $emailCollection->save();
        }
        return false;
    }

    public static function productFormatter($order): array
    {
        $orderProducts = [];
        if ($order->status === "done") {
            $order->created_at = $order->updated_at;
            $order->depositPayment = $order->total;
            $order->total = 0;
        }
        foreach ($order->product_size as $key => $item) {
            $product = ProductSize::where("product_id", "=", $item->product_id)->with("product")->with("size")->first();
            $orderProduct = [];
            $orderProduct["id"] = $key+1;
            $orderProduct["product_name_fulled"] = $product->product[0]->product_name . "(" . $product->product[0]->color . ") - " . $product->size[0]->size_type;
            $orderProduct["price"] = $product->product[0]->price;
            $orderProduct["quantity"] = $item->pivot->product_quantity;
            array_push($orderProducts, $orderProduct);

            $order->total += $orderProduct["price"]*$orderProduct["quantity"];
        }
        return $orderProducts;
    }

    public static function preparePivotData($pivot_values, $pivotColumns): array
    {
        $count = array_count_values($pivot_values);
        $sum = [];
        $keys = array_keys($count);

        for ($i = 0; $i < count($keys); $i++) {
            $sum[$i][$pivotColumns[0]] = $keys[$i];
            $sum[$i][$pivotColumns[1]] = $count[$keys[$i]];
        }
        return $sum;
    }

    public static function variableSymbol(): int|string
    {
        $order = Order::orderBy('order_id', 'DESC')->first();
        if(is_null($order)) {
            $order_id = 1;
        }else {
            $order_id = (integer)$order->order_id+1;
        }
        return date("Ymd").($order_id);
    }
}
