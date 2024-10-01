<?php

declare(strict_types=1);

namespace App\Enum;

enum CommentStatusEnum: string
{
    case PENDING = 'pending';
    case PUBLISH = 'publish';
    case REJECT = 'reject';
}
