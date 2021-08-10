<?php


namespace App\Services;


use App\Models\Quotation;
use App\Repositories\QuotationRepository;
use Exception;
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

    public function getById($id): ?Quotation
    {
        return $this->quotationRepository->getById($id);
    }

    public function deleteById($id): bool
    {
        return $this->quotationRepository->deleteById($id);
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

    /**
     * @throws ValidationException
     * @throws Exception
     */
    public function update($id, $data): ?Quotation
    {
        $validator = Validator::make($data, [
            'total' => 'required|numeric',
            'notes' => '',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->quotationRepository->update($id, $data);
    }
}
