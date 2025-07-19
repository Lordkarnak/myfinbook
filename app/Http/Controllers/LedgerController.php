<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class LedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : Response
    {
        if (!auth()->check()) {
            abort(403);
        }
        
        return Inertia::render('Ledgers/Index', [
            'user' => auth()->user()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->check()) {
            abort(403);
        }

        return Inertia::render('Ledgers/NewLedger');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : JsonResponse
    {
        if (!auth()->check()
            || $request->method() !== 'POST') {
            abort(403);
        }

        if (!$request->has('ledgerName') || $request->isNotFilled('ledgerName')) {
            return response()->json([
                'status' => 'FAIL',
                'message' => 'You must provide a valid ledger name'
            ]);
        }

        if (Ledger::where('name', '=', $request->input('ledgerName'))->first() !== null) {
            return response()->json([
                'status' => 'FAIL',
                'message' => 'The ledger you are trying to create already exists!'
            ]);
        }

        $newLedger = new Ledger([
            'name' => $request->input('ledgerName'),
            'is_bank' => $request->input('isBank'),
            'bank_owner' => $request->input('owner') ?? null,
            'bank_iban' => $request->input('iban') ?? null,
            'bank_bic' => $request->input('bic') ?? null,
            'description' => $request->input('description') ?? null
        ]);

        if (!$newLedger->save()) {
            return response()->json([
                'status' => 'FAIL',
                'message' => 'Could not save ledger. Operation aborted'
            ]);
        }

        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'The ledger was saved!'
        ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
