<?php


namespace App\Repositories;


use App\Models\Quotation;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class QuotationRepository
{
    private Quotation $quotation;

    public function __construct(Quotation $quotation)
    {
        $this->quotation = $quotation;
    }

    public function getAll(): Collection
    {
        return $this->quotation->get();
    }

    public function getById($id): ?Quotation
    {
        return $this->quotation->find($id);
    }

    public function deleteById($id): bool
    {
        $quotation = $this->getById($id);
        if ($quotation === null) return false;
        $quotation->delete();
        return true;
    }

    /**
     * @throws Exception
     */
    public function store($data): Quotation
    {
        $q = new $this->quotation;
        $q->customer = $data['customer'];
        $q->total = $data['total'];
        $q->notes = $data['notes'] ?? null;
        $q->save();
        return $q->fresh();
    }
}
