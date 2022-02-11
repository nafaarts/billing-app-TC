<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $table = "bank_account";
    protected $fillable = [
        "bank_name",
        "bank_detail",
        "bank_address",
        "bank_account_number",
        "bank_currency",
        "swift_code",
    ];
}
