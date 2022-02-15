<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remittance extends Model
{
    use HasFactory;

    protected $table = 'remittance';
    protected $fillable = ['remittance_no', 'date', 'bank_id', 'client_id', 'currency', 'gap_type', 'gap_value', 'created_by'];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function items()
    {
        return $this->hasMany(RemittanceItem::class);
    }

    public function amount()
    {
        return collect($this->items)->reduce(function ($total, $item) {
            return $total + ($item->wht != 1 || $item->wapu != 1 ? $item->invoice->amountWithPPN() : $item->invoice->amount());
        });
    }

    public function payOut()
    {
        return collect($this->items)->reduce(function ($total, $item) {
            return $total + ($item->net_amount + $item->pph_tax);
        });
    }
}
