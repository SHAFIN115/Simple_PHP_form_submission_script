<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function create()
    {
            return view('create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|integer',
            'buyer' => 'required|string|max:255',
            'receipt_id' => 'required|string|max:20',
            'items' => 'required|string|max:255',
            'buyer_email' => 'required|email|max:50',
            'buyer_ip' => 'nullable|string|max:20',
            'note' => 'required|string',
            'city' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
            'entry_by' => 'required|string|max:10',
        ]);
        
        $salt = 'my_salt'; 
        $hash_key = hash('sha512', $validatedData['receipt_id'].$salt);
    
        $order = new Order;
        $order->hash_key = $hash_key;
        $order->amount = $validatedData['amount'];
        $order->buyer = $validatedData['buyer'];
        $order->receipt_id = $validatedData['receipt_id'];
        $order->items = $validatedData['items'];
        $order->buyer_email = $validatedData['buyer_email'];
        $order->buyer_ip = $request->ip();
        $order->note = $validatedData['note'];
        $order->city = $validatedData['city'];
        $order->phone = $validatedData['phone'];
        $order->entry_by = $validatedData['entry_by'];
        $order->entry_at = now();
        $order->save();
    
        return redirect('/orders/create')->with('success', 'Order submitted successfully.');
    }
}
