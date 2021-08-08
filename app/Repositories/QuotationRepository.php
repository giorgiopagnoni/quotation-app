<?php


namespace App\Repositories;


use App\Models\Quotation;
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
}
