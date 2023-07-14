<?php

namespace App\Traits\Validation;

use App\Models\Customer\CustomerDocument;

trait UserDocumentValidation
{
    private function validateUserDocuments($customer)
    {
        $documents = CustomerDocument::from('customer_documents as cd')
            ->join('options as o', 'o.id', '=', 'cd.type')
            ->where('cd.customer_id', $customer->id)
            ->whereNull('cd.deleted_at')
            ->where('cd.status', 't')
            ->select('cd.issuance', 'cd.expiry', 'o.additional_info')->get();

        if ($documents->isEmpty()) {
            $this->documents = true;
            $this->documents_tab = true;
            return [
                'status' => false,
                'message' => 'Identity documents not found. Please add identity document to make transaction.'
            ];
        }

        $error = true;

        foreach ($documents as $d) {
            if ($d->additional_info == 'primary' && strtotime($d->expiry) > time()) {
                $error = false;
            }
        }
        if ($error) {
            $this->documents = true;
            $this->documents_tab = true;
            return [
                'status' => false,
                'message' => 'Identity documents are not found or your documents has been expired.'
            ];
        }

        return [
            'status' => true
        ];

    }
}
