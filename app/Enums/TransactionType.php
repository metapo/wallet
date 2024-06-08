<?php

namespace App\Enums;

enum TransactionType: string
{
    use CommonEnumTrait;

    case Deposit = 'deposit';
    case Withdraw = 'withdraw';
}
