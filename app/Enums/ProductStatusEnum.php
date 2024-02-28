<?php
declare(strict_types=1);

namespace App\Enums;

/**
 *
 */
enum ProductStatusEnum: string
{
    case SALE = 'sale';
    case OUT = 'out';

    case HIDDEN = 'hidden';

    case DELETED = 'deleted';
}

