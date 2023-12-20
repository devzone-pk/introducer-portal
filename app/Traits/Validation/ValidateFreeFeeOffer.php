<?php
namespace App\Traits\Validation;
use App\Models\FeeFreeTransfer;
use App\Models\Transfer\Transfer;
use App\Models\Transfer\TransferDetail;

trait ValidateFreeFeeOffer{


    public $free_fee_offer = [
        'status' => false,
        'id' => null,
        'save' => 0
    ];

    private function validateFreeFeeOffer()
    {

        $this->reset('free_fee_offer');


        $offer = FeeFreeTransfer::where('company_id', config('app.company_id'))
            ->where('expire_at', '>=', date('Y-m-d'))
            ->where('start_at', '<=', date('Y-m-d'))
            ->whereNull('deleted_at')
            ->where(function ($q) {
                return $q->orWhere('customer_id', session('customer_id'))
                    ->orWhereNull('customer_id');
            })
            ->where(function ($q) {
                return $q->orWhere('sending_country_id', session('country_id'))
                    ->orWhereNull('sending_country_id');
            })
            ->where(function ($q) {
                return $q->orWhere('receiving_country_id', $this->receiving_country['id'])
                    ->orWhereNull('receiving_country_id');
            })
            ->select('fee_free_counter', 'id', 'customer_id','description')->orderBy('customer_id', 'desc')->get();


        if ($offer->isEmpty()) {
            return false;
        }

        $offer = $offer->first()->toArray();
        if (!empty($offer['customer_id'])) {
            $count = TransferDetail::where('fee_free_transfer_id', $offer['id'])->count();
            if ($count < $offer['fee_free_counter']) {
                $this->free_fee_offer['id'] = $offer['id'];
                $this->free_fee_offer['status'] = true;
                $this->free_fee_offer['message'] = $offer['description'];
            }
        } else {
            $count = Transfer::where('customer_id', session('customer_id'))->count();
            if ($count < $offer['fee_free_counter']) {
                $this->free_fee_offer['id'] = $offer['id'];
                $this->free_fee_offer['status'] = true;
                $this->free_fee_offer['message'] = $offer['description'];
            }
        }
    }
}
