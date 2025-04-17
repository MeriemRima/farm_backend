<?php
 
namespace App\Http\Controllers;
 
use App\Models\Order;
use Illuminate\Http\Request;
 
class OrderController extends Controller
{
    // List all orders
    public function index()
    {
        return response()->json(Order::all());
    }
 
    // Get orders for a specific user
    public function getByUser($id)
    {
        $orders = Order::where('user_id', $id)->get();
        return response()->json($orders);
    }
 
    // Store a new order
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'    => 'required|integer',
            'product_id' => 'required|integer',
            'quantity'   => 'required|integer|min:1',
            'status'     => 'nullable|string'
        ]);
 
        $order = Order::create($validated);
        return response()->json($order, 201);
    }
 
    // Show a single order
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return response()->json($order);
    }
 
    // Update an existing order
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
 
        $validated = $request->validate([
            'user_id'    => 'sometimes|integer',
            'product_id' => 'sometimes|integer',
            'quantity'   => 'sometimes|integer|min:1',
            'status'     => 'nullable|string'
        ]);
 
        $order->update($validated);
        return response()->json($order);
    }
 
    // Delete an order
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
 
        return response()->json(['message' => 'Order deleted']);
    }
}