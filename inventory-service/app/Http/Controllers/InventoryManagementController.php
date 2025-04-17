<?php

namespace App\Http\Controllers;

use App\Models\InventoryManagement;
use Illuminate\Http\Request;

class InventoryManagementController extends Controller
{
    /**
     * List all inventory items.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $inventory = InventoryManagement::all();
        return response()->json($inventory);
    }

    /**
     * View inventory for a specific product.
     *
     * @param  int  $productId
     * @return \Illuminate\Http\JsonResponse
     */
    public function showByProduct($productId)
    {
        $inventory = InventoryManagement::where('product_id', $productId)->get();
        if ($inventory->isEmpty()) {
            return response()->json(['message' => 'No inventory found for this product'], 404);
        }
        return response()->json($inventory);
    }

    /**
     * Add a new inventory record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|integer',
            'stock' => 'required|integer|min:0',
        ]);

        $inventory = InventoryManagement::create($validatedData);
        return response()->json($inventory, 201);
    }

    /**
     * Update stock for an existing inventory record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $inventory = InventoryManagement::find($id);

        if (!$inventory) {
            return response()->json(['message' => 'Inventory record not found'], 404);
        }

        $validatedData = $request->validate([
            'stock' => 'required|integer|min:0',
        ]);

        $inventory->update($validatedData);
        return response()->json($inventory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventory = InventoryManagement::find($id);

        if (!$inventory) {
            return response()->json(['message' => 'Inventory record not found'], 404);
        }

        $inventory->delete();
        return response()->json(['message' => 'Inventory record deleted']);
    }
}
