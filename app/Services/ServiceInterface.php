<?php

namespace App\Services;

interface ServiceInterface
{
    public function format(\Illuminate\Support\Collection $collection): \Illuminate\Support\Collection;
}
