<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = "invoice";
    protected $fillable = [
        'invoice_no',
        'draft_no',
        'date',
        'job_reference',
        'terms',
        'description',
        'client_id',
        'bank_id',
        'tax_invoice',
        'ppn',
        'received_by',
        'received_date',
        'invoice_type',
        'created_by',
        'due_date'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }

    public function userBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items()
    {
        return $this->hasMany(Items::class);
    }

    public function amount()
    {
        return collect($this->items()->get())->reduce(function ($total, $item) {
            return $total + ($item->price *  $item->quantity);
        });
    }

    public function amountWithPPN()
    {
        return $this->invoice_type == 'invoice' ? ($this->amount() * $this->ppn) / 100 + $this->amount() : $this->amount();
    }

    public function getDescription()
    {
        return collect(json_decode($this->description))->toArray();
    }

    public function getAttachment()
    {
        return $this->hasMany(Attachment::class);
    }
}
