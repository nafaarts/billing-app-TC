<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemittanceItem extends Model
{
    use HasFactory;

    protected $table = 'remittance_item';
    protected $fillable = [
        'remittance_id',
        'invoice_id',
        'pph_tax',
        'net_amount',
        'remarks',
        'kurs',
        'wapu',
        'wht',
        'wht_id',
        'adm_other',
        'ssp_lb_date'
    ];

    public function remittace()
    {
        return $this->belongsTo(Remittance::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
