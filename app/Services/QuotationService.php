<?php


namespace App\Services;


use App\Repositories\QuotationRepository;
use Illuminate\Database\Eloquent\Collection;

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

    public function save($quotation){
        return $this->quotationRepository->getAll();
    }
}
