<?php

declare(strict_types=1);

namespace App\Modules\Approval\DTO;

use App\Domain\Enums\StatusEnum;
use App\Models\Invoice;
use Ramsey\Uuid\UuidInterface;

final class ApprovalDTO
{
    public function __construct(
        public UuidInterface $id,
        public StatusEnum $status,
    ) {
    }
}
