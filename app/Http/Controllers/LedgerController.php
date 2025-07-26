<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use App\Services\LedgerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class LedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : \Inertia\Response
    {
        if (!auth()->check()) {
            abort(\App\Services\HttpService::HTTP_RESPONSE_FORBIDDEN);
        }

        $ledgers = new LedgerService()->getLedgers();

        return Inertia::render('Ledgers/Index', [
            'user' => auth()->user(),
            'ledgers' => $ledgers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->check()) {
            abort(\App\Services\HttpService::HTTP_RESPONSE_FORBIDDEN);
        }

        return Inertia::render('Ledgers/NewLedger');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : \Inertia\Response|\Symfony\Component\HttpFoundation\Response
    {
        if (!auth()->check()
            || $request->method() !== \App\Services\HttpService::HTTP_METHOD_POST) {
            abort(\App\Services\HttpService::HTTP_RESPONSE_FORBIDDEN);
        }

        $validated = $request->validate([
            'ledgerName'    => ['required', 'max:100'],
            'description'   => ['max:400'],
            'isBank'        => ['boolean'],
            'bankOwner'     => ['required_if:isBank,1'],
        ]);

        if (Ledger::where('name', '=', $validated['ledgerName'])->first() !== null) {
            return Inertia::render('Ledgers/NewLedger')->with([
                'status' => \App\Services\HttpService::JSON_RESPONSE_STATUS_FAILED,
                'errors' => ['general' => 'The ledger you are trying to create already exists!']
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
            return Inertia::render('Ledgers/NewLedger')->with([
                    'status' => \App\Services\HttpService::JSON_RESPONSE_STATUS_FAILED,
                    'errors' => ['general' => 'Could not save ledger. Aborted!']
                ])
                ->toResponse($request)
                ->setStatusCode(\App\Services\HttpService::HTTP_RESPONSE_SERVER_ERROR);
        }

        return Inertia::render('Ledgers/Index')->with([
            'status' => \App\Services\HttpService::JSON_RESPONSE_STATUS_SUCCESS,
            'message' => 'A ledger was created.'
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
