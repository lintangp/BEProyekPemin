<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Budgetdata;
use App\Models\BudgetGroup;
use Illuminate\Http\Request;


class BudgetDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $budgetDatas = Budgetdata::all();
        return response()->json(['data' => $budgetDatas], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_kelompok_anggaran' => 'required|exists:budget_groups,id',
            'anggaran' => 'required|integer',
            'tanggal' => 'required|date',
            'jenis' => 'required|in:keluar,masuk',
            'keterangan' => 'nullable|string',
        ]);

        try {
            $budgetGroup = BudgetGroup::findOrFail($validatedData['id_kelompok_anggaran']);
            $budgetData = new BudgetData([
                'anggaran' => $validatedData['anggaran'],
                'tanggal' => $validatedData['tanggal'],
                'jenis' => $validatedData['jenis'],
                'keterangan' => $validatedData['keterangan'],
            ]);

            $budgetGroup->budgetData()->save($budgetData);

            return response()->json(['message' => 'Budget data created successfully', 'data' => $budgetData], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create budget data', 'error' => $e->getMessage()], 500);
        }
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
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'id_kelompok_anggaran' => 'required|exists:budget_groups,id',
            'anggaran' => 'required|integer',
            'tanggal' => 'required|date',
            'jenis' => 'required|in:keluar,masuk',
            'keterangan' => 'nullable|string',
        ]);

        try {
            $budgetData = BudgetData::findOrFail($id);

            $budgetGroup = BudgetGroup::findOrFail($validatedData['id_kelompok_anggaran']);

            $budgetData->anggaran = $validatedData['anggaran'];
            $budgetData->tanggal = $validatedData['tanggal'];
            $budgetData->jenis = $validatedData['jenis'];
            $budgetData->keterangan = $validatedData['keterangan'];

            $budgetData->budgetGroup()->associate($budgetGroup);

            $budgetData->save();

            return response()->json(['message' => 'Budget data updated successfully', 'data' => $budgetData], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update budget data', 'error' => $e->getMessage()], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $budgetData = BudgetData::findOrFail($id);
            $budgetData->delete();

            return response()->json(['message' => 'Budget data deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete budget data', 'error' => $e->getMessage()], 500);
        }
    }
}
