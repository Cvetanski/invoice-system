<?php

namespace App\Http\Controllers\Invoice;

use App\Domain\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Modules\Approval\Application\ApprovalFacade;
use App\Modules\Approval\ApprovalFacadeInterface;
use App\Modules\Approval\DTO\ApprovalDTO;
use App\Modules\Approval\Events\InvoiceApproved;
use App\Modules\Invoices\Commands\AllInvoicesCommand;
use App\Modules\Invoices\Infrastructure\Exceptions\ApprovalStatusAlreadyRegistered;
use App\Modules\Invoices\Infrastructure\InvoiceRepository;
use App\Modules\Invoices\Repositories\Contracts\InvoiceRepositoryInterface;
use App\Modules\Invoices\Repositories\EloquentInvoiceRepository;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class InvoiceController extends Controller
{

    public function index(InvoiceRepositoryInterface $invoiceRepository)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => (new AllInvoicesCommand($invoiceRepository))->handle()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function approve(Request $request, InvoiceRepository $invoiceRepository, ApprovalFacadeInterface $approvalFacade)
    {
        try {
            $approvalDto = new ApprovalDTO(Uuid::fromString($request->id), StatusEnum::APPROVED);
            $approvalFacade->approve($approvalDto);
            $invoiceRepository->updateStatus($approvalDto, StatusEnum::APPROVED, $approvalFacade);


            return response()->json([
                'message' => 'Invoice status updated successfully.',
            ]);
        } catch (\Exception $e) {
            if ($e instanceof ApprovalStatusAlreadyRegistered) {
                return $e->render($request);
            }

            return response()->json([
                'message' => 'An error occurred while updating invoice status: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function reject(Request $request, InvoiceRepository $invoiceRepository, ApprovalFacadeInterface $approvalFacade)
    {
        try {
            $approvalDto = new ApprovalDTO(Uuid::fromString($request->id), StatusEnum::REJECTED);
            $approvalFacade->reject($approvalDto);
            $invoiceRepository->updateStatus($approvalDto, StatusEnum::REJECTED, $approvalFacade);

            return response()->json([
                'message' => 'Invoice status updated successfully.',
            ]);
        } catch (\Exception $e) {
            if ($e instanceof ApprovalStatusAlreadyRegistered) {
                return $e->render($request);
            }
            return response()->json([
                'message' => 'An error occurred while updating invoice status: ' . $e->getMessage(),
            ], 500);
        }
    }

}
