<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Affiche la liste des fournisseurs
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return response()->json($suppliers);
    }

    /**
     * Crée un nouveau fournisseur
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email',
            'farmer_id'=>'required',
        ]);

        $supplier = Supplier::create($validated);
        return response()->json($supplier, 201);
    }

    /**
     * Affiche un fournisseur spécifique
     */
    public function show(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        return response()->json($supplier);
    }

    /**
     * Met à jour un fournisseur
     */
    public function update(Request $request, string $id)
    {
        $supplier = Supplier::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:suppliers,email,'.$supplier->id,
        ]);

        $supplier->update($validated);
        return response()->json($supplier);
    }

    /**
     * Supprime un fournisseur
     */
    public function destroy(string $id)
    {
        Supplier::destroy($id);
        return response()->noContent();
    }
}