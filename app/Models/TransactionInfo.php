<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TransactionInfo extends Model
{
    protected $table = 'transactions_info';

    protected $fillable = [
        'transaction_id',
        'beneficiary',
        'amount',
        'description',
        'immediate',
        'process_date'
    ];

    public function transaction() : BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function currency() : HasOne
    {
        return $this->hasOne(Currency::class);
    }
}
