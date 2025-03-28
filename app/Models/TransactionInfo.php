<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
