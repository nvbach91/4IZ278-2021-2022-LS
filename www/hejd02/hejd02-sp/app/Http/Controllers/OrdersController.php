<?php

namespace App\Http\Controllers;


use App\Custom\Features;
use App\Custom\Texts;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\QueryException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use App\Custom\Emails;

class OrdersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        if (Gate::allows('your-orders', Order::all())) {
            return OrderResource::collection(Order::where("user_id", "=", auth()->user()->user_id)->get());
        }
        return OrderResource::collection(Order::orderBy('order_id', 'desc')->get());
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return OrderResource
     */
    public function show(Order $order): OrderResource
    {
        Gate::authorize('manage-orders', $order);
        return new OrderResource($order);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrderRequest $request
     * @return OrderResource
     */
    public function store(OrderRequest $request): OrderResource
    {
        Gate::authorize('create-orders', $request);

        $order = Order::create([
            'user_id' => $request->input("user_id"),
            'address_id' => 1,
            'status' => Texts::ORDER_STATUS[0],
            'variable_symbol' => Features::variableSymbol(),
            'note' => $request->input("note"),
        ]);
        $order->user()->associate(User::find($request->input("user_id")));

        $pivotColumns = ["product_size_id", "product_quantity"];
        $pivotData = Features::preparePivotData($request->input("products"), $pivotColumns);

        $order->product_size()->attach(
            $pivotData
        );

        $orderProducts = Features::productFormatter($order);
        $pdf = PDF::loadView('pdf', ['data' => $order, 'products' => $orderProducts, 'total' => $order->total, 'depositPayment' => $order->total]);

        Emails::orderAdminEmail($order, $orderProducts, $pdf);
        Emails::orderUserEmail($order, $orderProducts, $pdf);

        return new OrderResource($order);
    }


    /**
     * Display the specified resource.
     * @param Order $order
     */
    public function orderInvoice(Order $order): Response
    {
        $orderProducts = Features::productFormatter($order);

        $pdf = PDF::loadView('pdf', ['data' => $order, 'products' => $orderProducts]);
        return $pdf->stream();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Order $order
     * @return OrderResource
     */
    public function update(Order $order): OrderResource
    {
        if ($order->status === Texts::ORDER_STATUS[0]) {
            $order->update([
                'status' => Texts::ORDER_STATUS[1]
            ]);

            $order = new OrderResource($order);
            $orderProducts = Features::productFormatter($order);
            $pdf = PDF::loadView('pdf', ['data' => $order, 'products' => $orderProducts, 'total' => $order->total, 'depositPayment' => $order->total]);

            Emails::orderUserEmail($order, $orderProducts, $pdf);
        }
        return new OrderResource($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return Response
     */
    public function destroy(Order $order): Response
    {
        try {
            $order->delete();
        } catch (QueryException $e) {
            return response($e->errorInfo, 409);
        }

        return response(null, 204);
    }

}
