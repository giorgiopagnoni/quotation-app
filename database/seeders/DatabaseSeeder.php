<?php

namespace Database\Seeders;

use App\Services\QuotationService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    private QuotationService $quotationService;

    public function __construct(QuotationService $quotationService)
    {
        $this->quotationService = $quotationService;
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@quotationapp.com',
            'password' => Hash::make('password'),
            // 'email_verified_at' => (new \DateTime())->format('Y-m-d H:i:s')
        ]);

        $this->quotationService->store([
            'customer' => 'Sintattica SRL',
            'total' => 200.24
        ]);

        $this->quotationService->store([
            'customer' => 'Jobtech SRL',
            'total' => 189
        ]);

        $this->quotationService->store([
            'customer' => 'ACME SPA',
            'total' => 600,
            'notes' => 'notes'
        ]);
    }
}
