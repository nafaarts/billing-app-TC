<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wht extends Model
{
    use HasFactory;
    protected $table = 'wht';
    protected $fillable = [
        'client_id',
        'reference_code',
        'wht_number',
        'wht_date',
        'percentage',
        'filename'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function status()
    {
        return $this->filename != null;
    }
}
