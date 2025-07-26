<?php

namespace App\Services;

class LedgerService
{
    public const ORDER = [
        'id' => 'id',
        'name' => 'name',
        'date_created' => 'date_created'
    ];

    public function makeLedger(array $userData): bool
    {
        return true;
    }

    /**
     * @param array $filters
     * @param string $orderBy
     * @throws \App\Exceptions\InvalidOrderException
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getLedgers(array $filters = [], string $orderBy = 'name'): \Illuminate\Database\Eloquent\Collection
    {
        if (!self::orderIsValid($orderBy)) {
            throw new \App\Exceptions\InvalidOrderException('Cannot order query by ' . $orderBy);
        }

        return \App\Models\Ledger::query()
            ->orderBy($orderBy)
            ->get();
    }

    public function orderIsValid(string $orderBy): bool
    {
        return $orderBy && isset(self::ORDER[$orderBy]);
    }
}
