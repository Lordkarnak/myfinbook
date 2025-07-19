<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function transactions() : HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
