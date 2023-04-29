<?php

declare(strict_types=1);

namespace App\Modules\Approval\Events;

use App\Modules\Approval\DTO\ApprovalDTO;

final readonly class InvoiceRejected
{
    public function __construct(
        public ApprovalDTO $approvalDTO
    ) {
    }
}
