<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    protected $table = "items";
    protected $fillable = [
        'invoice_id',
        'item_detail',
        'price',
        'quantity',
        'services_id'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function service()
    {
        return $this->belongsTo(Services::class, 'services_id');
    }
}
