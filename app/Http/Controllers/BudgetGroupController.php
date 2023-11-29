<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BudgetGroup;

class BudgetGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $budgetGroups = BudgetGroup::all();
        return response()->json(['data' => $budgetGroups], 200);
    }

    /**
     * Show the form for creat  ing a new resource.
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kelompok' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $budgetGroup = BudgetGroup::create([
            'nama_kelompok' => $validatedData['nama_kelompok'],
            'deskripsi' => $validatedData['deskripsi'],
        ]);

        return response()->json(['message' => 'Budget group created successfully', 'data' => $budgetGroup], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $budgetGroup = BudgetGroup::findOrFail($id);

        $validatedData = $request->validate([
            'nama_kelompok' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);
        $budgetGroup->update([
            'nama_kelompok' => $validatedData['nama_kelompok'],
            'deskripsi' => $validatedData['deskripsi'],
        ]);

        return response()->json(['message' => 'Budget group updated successfully', 'data' => $budgetGroup], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $budgetGroup = BudgetGroup::findOrFail($id);

        $budgetGroup->delete();

        return response()->json(['message' => 'Budget group deleted successfully'], 200);
    }
}
