<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    protected $fillable = [
        'id',
        'number',
        'due_date',
        'company_id',
        'status'
    ];

    public function getUuidAttribute(): string
    {
        return Uuid::fromString($this->attributes['id']);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'invoice_products')
            ->withPivot('quantity');
    }

    public function invoiceProducts()
    {
        return $this->hasMany(InvoiceProduct::class);
    }

    public function jsonSerialize() :array
    {
        return [
            'id' => $this->uuid,
            'number' => $this->number,
            'due_date' => $this->due_date,
            'company' => [
                'name' => $this->company->name,
                'street_address' => $this->company->street,
                'city' => $this->company->city,
                'zip_code' => $this->company->zip,
                'phone' => $this->company->phone,
                'billed_company' => [
                    'name' => $this->company->name,
                    'street_address' => $this->company->street,
                    'city' => $this->company->city,
                    'zip_code' => $this->company->zip,
                    'phone' => $this->company->phone,
                    'email' => $this->company->email,
                ],
            ],
            'products' => $this->invoiceProducts->map(function ($invoiceProduct) {
                return [
                    'name' => $invoiceProduct->product->name,
                    'quantity' => $invoiceProduct->quantity,
                    'unit_price' => $invoiceProduct->product->price,
                    'total' => "$" . $invoiceProduct->quantity * $invoiceProduct->product->price,
                ];
            }),
            'total_price' => "$" . $this->invoiceProducts->sum(function ($invoiceProduct) {
                return $invoiceProduct->quantity * $invoiceProduct->product->price;
            }),
        ];
    }
}
