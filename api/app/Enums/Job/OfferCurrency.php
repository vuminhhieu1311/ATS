<?php

namespace App\Enums\Job;

final class OfferCurrency
{
    public const VND = 'VND';
    public const USD = 'USD';

    public const ALL_CURRENCY = [
        self::VND,
        self::USD,
    ];
}
