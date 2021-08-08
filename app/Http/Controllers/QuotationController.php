<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuotationRequest;
use App\Services\QuotationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    private QuotationService $quotationService;

    public function __construct(QuotationService $quotationService)
    {
        $this->quotationService = $quotationService;
    }

    public function index(): JsonResponse
    {
        $quotes = $this->quotationService->getAll();
        return response()->json($quotes);
    }

    public function store(StoreQuotationRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $this->quotationService->create($validated);
    }


    public function show($id): JsonResponse
    {
        //
    }


    public function update(Request $request, $id): JsonResponse
    {
        //
    }


    public function destroy($id): JsonResponse
    {
        //
    }
}
