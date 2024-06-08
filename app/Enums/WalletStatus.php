<?php

namespace App\Enums;

enum WalletStatus: string
{
    use CommonEnumTrait;
    case Active = 'active';
    case Inactive = 'inactive';
    case Archived = 'archived';
}
