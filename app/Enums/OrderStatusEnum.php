<?php

declare(strict_types=1);

namespace App\Enums;

enum OrderStatusEnum: string
{
    case CANCELLED = 'CANCELLED';

    case PAID = 'PAID';

    case DRAFT = 'DRAFT';

    case SHIPPED = 'SHIPPED';
}
