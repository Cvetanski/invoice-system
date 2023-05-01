<?php
namespace App\Modules\Invoices\Infrastructure;

use App\Domain\Enums\StatusEnum;
use App\Models\Invoice;
use App\Modules\Approval\ApprovalFacadeInterface;
use App\Modules\Approval\DTO\ApprovalDTO;
use App\Modules\Approval\Events\InvoiceApproved;
use App\Modules\Invoices\Infrastructure\Exceptions\ApprovalStatusAlreadyRegistered;

class InvoiceRepository
{

    public function updateStatus(ApprovalDTO $approvalDto, StatusEnum $newStatus, ApprovalFacadeInterface $approvalFacade): void
    {
        $invoice = Invoice::findOrFail($approvalDto->id);
        $invoice->status = $newStatus;

        $invoice->update();
    }


}
