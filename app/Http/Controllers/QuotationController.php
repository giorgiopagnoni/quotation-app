<?php

namespace App\Http\Controllers;

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

    public function show($id): JsonResponse
    {
        $result['data'] = $this->quotationService->getById($id);
        $status = $result['data'] !== null ? 200 : 404;
        return response()->json($result, $status);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $status = 200; // resource created AND returned
            $result['data'] = $this->quotationService->store($request->toArray());
        } catch (ValidationException $validationException) {
            $status = 422;
            $result['data']['errors'] = $validationException->errors();
        } catch (\Exception $exception) {
            $status = 500;
            $result['data'] = $exception->getMessage();
        }

        return response()->json($result, $status);
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $result['data'] = $this->quotationService->update($id, $request->toArray());
            $status = $result['data'] ? 200 : 404;
        } catch (ValidationException $validationException) {
            $status = 422;
            $result['data']['errors'] = $validationException->errors();
        } catch (\Exception $exception) {
            $status = 500;
            $result['data'] = $exception->getMessage();
        }

        return response()->json($result, $status);
    }


    public function destroy($id): JsonResponse
    {
        $deleted = $this->quotationService->deleteById($id);
        $status = $deleted === true ? 204 : 404;
        return response()->json('', $status);
    }
}
