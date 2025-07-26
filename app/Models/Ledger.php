<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Date;

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

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn(string $name): string => ucfirst($name),
        );
    }

    protected function casts(): array
{
    return [
        'created_at' => 'datetime:' . config('display.datetime_format'),
    ];
}

    public function transactions() : HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
