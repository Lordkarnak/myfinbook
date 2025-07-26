<?php

namespace App\Services;

class LedgerService implements ServiceInterface
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
    public function getLedgers(array $filters = [], string $orderBy = 'name'): \Illuminate\Support\Collection
    {
        if (!self::orderIsValid($orderBy)) {
            throw new \App\Exceptions\InvalidOrderException('Cannot order query by ' . $orderBy);
        }

        return $this->format(
            \App\Models\Ledger::query()
            ->orderBy($orderBy)
            ->get()
        );
    }

    public function orderIsValid(string $orderBy): bool
    {
        return $orderBy && isset(self::ORDER[$orderBy]);
    }

    public function format(\Illuminate\Support\Collection $collection): \Illuminate\Support\Collection
    {
        return $collection->map(function(\App\Models\Ledger $item): \App\Models\Ledger {
            $item['url'] = route('ledgers.show', ['ledger' => $item->id]);
            $item['income'] = 0;
            $item['expenses'] = 0;
            $item['balance'] = 0;

            return $item;
        });
    }
}
