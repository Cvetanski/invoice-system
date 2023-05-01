<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class, 'invoice_products')->withPivot('quantity');
    }

    public function invoiceProducts()
    {
        return $this->hasMany(InvoiceProduct::class);
    }
}
