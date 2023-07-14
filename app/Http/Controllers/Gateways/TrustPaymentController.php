<?php

namespace App\Http\Controllers\Gateways;

use Ahc\Jwt\JWT;
use App\Http\Controllers\Controller;
use App\Mail\TransferCreated;
use App\Models\Transfer\GatewayResponse;
use App\Models\Transfer\Transfer;
use App\Models\Transfer\TransferNote;
use App\Models\TransferReference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class TrustPaymentController extends Controller
{
    public function index($transfer_code)
    {
        $lock = Cache::lock('transfer.gateway.' . $transfer_code, 10);
        if ($lock->get()) {
            $req = request()->all();
            $transfer = Transfer::where('transfer_code', $transfer_code)->where('status', 'INC')->get();
            if ($transfer->isEmpty()) {
                return;
            }
            $transfer = $transfer->first();
            $sender = $transfer->sender;
            $country = $transfer->senderTransferCountry;
            $details = $transfer->transferDetails;
            $reference_code = $this->generateReferenceCode($transfer);

            $jwt = new  JWT(config('gateways.trust-payment.key'));
            $total = bcadd($transfer->sending_amount, $transfer->company_charges, 2); // 2 decimal places
            $total = bcmul($total, '100', 0);
            $token = $jwt->encode([
                'iat' => time(),
                'iss' => config('gateways.trust-payment.iss'),
                'payload' => [
                    'customerfirstname' => $sender->first_name,
                    'customerlastname' => $sender->last_name,
                    'customerpremise' => $sender->house_no,
                    'customerstreet' => $sender->street_name,
                    'customerpostcode' => $sender->postal_code,


                    'accounttypedescription' => 'ECOM',
                    'currencyiso3a' => $country->currency,
                    'baseamount' => $total,

                    'billingfirstname' => $sender->first_name,
                    'billinglastname' => $sender->last_name,
                    'billingpremise' => $sender->house_no,
                    'billingstreet' => $sender->street_name,
                    'billingpostcode' => $sender->postal_code,


                    "requesttypedescriptions" => ["THREEDQUERY", "AUTH"],
                    'sitereference' => config('gateways.trust-payment.sitereference'),
                    'orderreference' => $reference_code,
                    'customfield1' => $transfer_code
                ]
            ]);

            if ($details['created_on'] == 'w' && empty($req['mobile'])) {
                return view('inner.gateways.trust-payments.index', compact('token', 'transfer', 'country', 'sender', 'details', 'reference_code'));
            } else {
                return view('inner.gateways.trust-payments.mobile-index', compact('token', 'transfer', 'country', 'sender', 'details', 'reference_code'));
            }
        }
    }

    private function generateReferenceCode($transfer)
    {
        $code = md5(uniqid() . $transfer->id . $transfer->transfer_code . Str::random(10) . Str::uuid());
        $ref = TransferReference::create([
            'transfer_code' => $transfer->transfer_code,
            'reference' => $code
        ]);
        return $code;
    }

    public function response(Request $request)
    {
        $response = ($request->all());

        $jwt = new  JWT(config('gateways.trust-payment.key'));
        if (empty($response['jwt'])) {
            Log::error('response trust', [$response]);
            return 'Something went wrong. Please try again.';
        }

        $data = $jwt->decode($response['jwt']);
        $data = json_decode(json_encode($data), true);


        $transfer = $data['payload']['response'][0]['customfield1'] ?? null;
        $details = Transfer::where('transfer_code', $transfer)
            ->where('status', 'INC')
            ->where('company_id', config('app.company_id'))->first();
        if (!empty($details) && $data['payload']['response'][0]['errorcode'] == 0) {

            $collect = collect($data['payload']['response']);


            $first = $collect->where('baseamount', '>', 0)->first();


            //$mail = (new TransferCreated($details))->onQueue('portal_' . config('app.company_id'));
            //Mail::to(session('email'))->queue($mail);


            GatewayResponse::create([
                'transfer_code' => $transfer,
                'card' => $first['maskedpan'],
                'status' => $first['status'] ?? '',
                'enrolled' => $first['enrolled'] ?? '',
                'amount' => $first['baseamount'] / 100,
                'authcode' => $first['authcode'] ?? '',
                'orderreference' => $first['orderreference'],
                'notificationreference' => $first['transactionreference'],
                'payload' => json_encode($data)
            ]);

            $update = Transfer::where('transfer_code', $transfer)
                ->where('status', 'INC')
                ->where('company_id', config('app.company_id'))->update([
                    'status' => 'VER'
                ]);

            if ($update) {
                TransferNote::create([
                    'transfer_id' => $details['id'],
                    'type' => '89', //webhook
                    'description' => 'Status has been updated as per success response from trust payments.',
                    'added_by' => '1',
                    'is_private' => 't'
                ]);
            }


        }

        $transfer_details = $details->transferDetails;
        if (!empty($transfer_details)) {
            if ($transfer_details->created_on == 'w') {
                return redirect('/transfer/success?transfer_code=' . $transfer);
            }
        }
        return view('mobile.gateways.success', compact('details'));
    }
}
