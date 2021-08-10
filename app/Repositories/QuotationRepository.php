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
        return (bool)$this->getById($id)?->delete();
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

    /**
     * @throws Exception
     */
    public function update($id, $data): ?Quotation
    {
        $q = $this->getById($id);
        if (!$q) return null;
        $q->total = $data['total'];
        $q->notes = $data['notes'] ?? null;
        $q->update();
        return $q;
    }
}
