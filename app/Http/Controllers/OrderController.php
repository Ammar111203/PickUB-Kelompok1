<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('order');
    }

    public function store(Request $request)
    {
        $request->validate([
            'origin' => 'required',
            'destination' => 'required',
            'order_type' => 'required',
            'description' => 'nullable|string',
        ]);

        $cost = $this->calculateCost($request->origin, $request->destination);
        // $idx = $this->calculateId();
        $idx = 1;

        $order = Order::create([
            'origin' => $request->origin,
            'destination' => $request->destination,
            'order_type' => $request->order_type,
            // 'user_id' => auth()->id(),//butuh authorisasi yagit 
            'user_id' => $idx,
            'cost' => $cost,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Order placed successfully!');
    }

    private function calculateCost($origin, $destination)
    {
        //misal berapa harga
        return rand(10, 100);
    }
    private function calculateId()
    {
        // misal id gak ter author
        return rand(10, 1000);
    }
}
