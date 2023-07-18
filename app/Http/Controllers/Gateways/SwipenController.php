<?php

namespace App\Http\Controllers\Gateways;

use Ahc\Jwt\JWT;
use App\Http\Controllers\Controller;
use App\Models\Transfer\GatewayResponse;
use App\Models\Transfer\Transfer;
use App\Models\Transfer\TransferNote;
use App\Models\TransferReference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class SwipenController extends Controller
{
    public function index($transfer_code)
    {
        die;
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


            $total = bcadd($transfer->sending_amount, $transfer->company_charges, 2); // 2 decimal places
            $total = bcmul($total, '100', 0);


            $packet = [
                'merchantID' => '252393',
                'action' => 'SALE',
                'type' => '1',
                'currencyCode' => '826',
                'countryCode' => '826',
                'amount' => $total,
                'orderRef' => $transfer_code,
                'transactionUnique' => $reference_code,
                'redirectURL' => 'https://xmgfinancialservices.com/gateway/swipen/payment/' . session('token'),
                'customerAddress' => $sender->house_no . ' ' . $sender->street_name . ' ' . $sender->city_name,
                'customerPostCode' => $sender->postal_code,
                'customerName' => $sender->first_name . ' ' . $sender->last_name,
                'customerEmail' => session('email'),
                'customerPhone' => $sender->phone,
                'customerCounty' => $transfer->sending_country
            ];
            ksort($packet);

            $str = http_build_query($packet, '', '&');
            $str = str_replace(array('%0D%0A', '%0A%0D', '%0D'), '%0A', $str);
            $str .= 'T3roecalO';
            $signature = hash('SHA512', $str);
            $packet['signature'] = $signature;

            return view('inner.gateways.swipen.index', compact('packet', 'transfer', 'country', 'sender', 'details', 'reference_code'));

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

    public function response(Request $request, $token)
    {
        $response = ($request->all());

        Session::put(['token' => $token]);
        $transfer = $response['orderRef'] ?? null;
        $details = Transfer::where('transfer_code', $transfer)
            ->where('status', 'INC')
            ->where('company_id', config('app.company_id'))->first();

        if (!empty($details) && $response['responseCode'] == '0') {
            $collect = collect($response);

            GatewayResponse::create([
                'transfer_code' => $transfer,
                'card' => $response['cardNumberMask'],
                'status' => $response['responseStatus'] ?? '',
                'enrolled' => $response['threeDSEnrolled'] ?? '',
                'amount' => $response['amount'] / 100,
                'authcode' => $response['responseMessage'] ?? '',
                'orderreference' => $response['transactionUnique'],
                'notificationreference' => $response['xref'],
                'payload' => json_encode($response)
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

        } else {

        }


        $transfer_details = $details->transferDetails;

        if (!empty($transfer_details)) {
            if ($transfer_details->created_on == 'w') {
                return redirect('/transfer/success?transfer_code=' . $transfer . '&error=' . $response['responseCode']);
            }
        }

        return view('mobile.gateways.success', compact('details', 'response'));

    }
}
