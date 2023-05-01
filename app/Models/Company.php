<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected  $fillable =[
        'name',
        'street',
        'city',
        'phone',
        'email'
    ];

    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }

}
