<?php

namespace App\Modules\Invoices\Repositories;

use App\Models\Invoice;
use App\Modules\Invoices\Repositories\Contracts\InvoiceRepositoryInterface;

class EloquentInvoiceRepository implements InvoiceRepositoryInterface
{
    public function all() :array
    {
        return Invoice::all()->all();
    }
}
