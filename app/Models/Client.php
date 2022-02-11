<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = "client";
    protected $fillable = [
        "company_code",
        "company_name",
        "company_address",
        "company_npwp",
        "company_departement"
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
