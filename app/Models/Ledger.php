<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    protected $table = 'ledgers';

    protected $fillable = [
        'name',
        'is_bank',
        'bank_owner',
        'bank_iban',
        'bank_bic',
        'description'
    ];
}
