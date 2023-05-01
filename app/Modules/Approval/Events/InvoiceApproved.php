<?php

declare(strict_types=1);

namespace App\Modules\Approval\Events;

use App\Modules\Approval\DTO\ApprovalDTO;
use Illuminate\Support\Facades\Mail;

final class InvoiceApproved
{
    public function __construct(public ApprovalDTO $approvalDTO)
    {

    }


    public function handle()
    {
//        Just for example

//        $recipient = $this->approvalDTO->user->email;
//        $subject = "Your invoice has been approved";
//        $body = "Dear " . $this->approvalDTO->user->name . ",\n\nYour invoice with ID " . $this->approvalDTO->id . " has been approved.\n\nThank you.";
//        Mail::to($recipient)->send(new InvoiceApprovedNotification($subject, $body));
    }

}
