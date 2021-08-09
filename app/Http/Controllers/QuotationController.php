<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuotationRequest;
use App\Services\QuotationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
        return response()->json(['data' => $quotes]);
    }

    public function store(Request $request): JsonResponse
    {
        $result['status'] = 201;

        try {
            $result['data'] = $this->quotationService->store($request->toArray());
        } catch (ValidationException $validationException) {
            $result['status'] = 422;
            $result['data']['errors'] = $validationException->errors();
        } catch (\Exception $exception) {
            $result['status'] = 500;
            $result['data'] = $exception->getMessage();
        }

        return response()->json($result['data'], $result['status']);
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
