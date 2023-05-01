<?php

namespace App\Modules\Invoices\Commands;

use App\Modules\Invoices\Repositories\Contracts\InvoiceRepositoryInterface;
use Illuminate\Http\Request;

class AllInvoicesCommand
{
    private $invoiceRepository;

    public function __construct(InvoiceRepositoryInterface $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    public function handle()
    {
        return $this->invoiceRepository->all();
    }


}
