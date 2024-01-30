<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'wallet_id',
        'type',
        'amount',
        'direction',
        'timestamp',
        'fraudulent',
    ];

    public $timestamps = false;

    public function account(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }
}
