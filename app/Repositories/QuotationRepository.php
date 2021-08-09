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
