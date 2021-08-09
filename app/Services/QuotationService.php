<?php


namespace App\Services;


use App\Http\Requests\StoreQuotationRequest;
use App\Models\Quotation;
use App\Repositories\QuotationRepository;
use Exception;
use http\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class QuotationService
{
    private QuotationRepository $quotationRepository;

    public function __construct(QuotationRepository $quotationRepository)
    {
        $this->quotationRepository = $quotationRepository;
    }

    public function getAll(): Collection
    {
        return $this->quotationRepository->getAll();
    }

    /**
     * @throws ValidationException
     * @throws Exception
     */
    public function store($data): Quotation
    {
        $validator = Validator::make($data, [
            'customer' => 'required|min:5|max:100',
            'total' => 'required|numeric',
            'notes' => '',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->quotationRepository->store($data);
    }
}
