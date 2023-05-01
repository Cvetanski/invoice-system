<?php
namespace App\Modules\Invoices\Infrastructure\Exceptions;

use LogicException;

class ApprovalStatusAlreadyRegistered extends LogicException
{
    public function render($request)
    {
        return response()->json([
            'message' => 'Approval status already registered',
            'errors' => [
                'status' => [
                    'Only draft invoices status can be updated'
                ],
            ]
        ], 422);
    }

}
