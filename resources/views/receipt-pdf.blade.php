<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body onload="window.print()">
@if(!empty($transfer))
    <div class="container py-3">

        <div class="d-flex justify-content-between  align-items-center">
            <div>
                <img src="{{ env('COMPANY_LOGO') }}"  style="width: 90px;" class="navbar-brand-img" alt="">
            </div>
            <div class="text-center">
                <p class="mb-0">Transfer Date & Time</p>
                <h4 class="mb-0">{{ date('d M, Y h:i A',strtotime($transfer['created_at'])) }}</h4>
            </div>

            <div class="text-end">
                <p class="mb-0 ">Transaction Receipt</p>
                <h4 class="mb-0">{{ $transfer['transfer_code'] }}</h4>
            </div>

        </div>
        <div class="row gap-4 mt-4">
            <div class="col border border-dark rounded p-2">
            <span
                style="position: relative;background-color: #fff;top: -25px;padding: 0px 6px;font-size: 20px;font-weight: 700;">Sender Details</span>

                <table class="w-100" style="font-size: 12px;">
                    <tr>
                        <th class="text-end">ID:</th>
                        <td>{{ $transfer['id'] }}</td>
                    </tr>
                    <tr>
                        <th class="text-end ">Name:</th>
                        <td>{{ $transfer->sender->first_name }} {{ $transfer->sender->last_name}}</td>
                    </tr>
                    <tr>
                        <th class="text-end">Phone:</th>

                        <td>{{ $transfer->sender->phone_code  }} {{ $transfer->sender->phone }}</td>
                    </tr>
                    <tr>
                        <th class="text-end">Sending Method:</th>
                        <td>{{ $transfer->sendingMethod->name }}</td>
                    </tr>
                    <tr>
                        <th class="text-end" style="width: 100px">Address:</th>
                        <td>{{ $transfer->sender->house_no }} {{ $transfer->sender->street_name }} {{ $transfer->sender->postal_code }}
                            , {{ $transfer->sender->city_name }} {{ $transfer->sending_country }}</td>
                    </tr>
                </table>

            </div>
            <div class="col border   border-dark rounded p-2">
            <span
                style="position: relative;background-color: #fff;top: -25px;padding: 0px 6px;font-size: 20px;font-weight: 700;">Receiver Details</span>
                <table class="w-100" style="font-size: 12px;">
                    <tr>
                        <th class="text-end  " style="width: 120px">Name:</th>
                        <td>{{ $transfer->beneficiary->first_name }} {{ $transfer->beneficiary->last_name }}</td>
                    </tr>
                    <tr>
                        <th class="text-end ">Telephone:</th>
                        <td>{{ $transfer->beneficiary->code }} {{ $transfer->beneficiary->phone }}</td>
                    </tr>
                    <tr>
                        <th class="text-end ">Receiving Method:</th>
                        <td>{{ $transfer->receivingMethod->name }}</td>
                    </tr>

                    <tr>
                        <th class="text-end ">Receive From:</th>
                        <td>{{ $transfer->payer->name }}</td>
                    </tr>
                    @if($transfer->receivingMethod->name== 'Bank')
                        @php
                            $bank = \App\Models\Transfer\TransferBeneficiaryBank::where('transfer_id',$transfer['id'])->first();
                        @endphp
                        <tr>
                            <th class="text-end ">Bank:</th>
                            <td>{{ $bank->name }}</td>
                        </tr>
                        @if(!empty($bank['branch_name']))
                            <tr>
                                <th class="text-end ">Branch Name:</th>
                                <td>{{ $bank->branch_name }}</td>
                            </tr>
                        @endif
                        @if(!empty($bank['branch_code']))
                            <tr>
                                <th class="text-end ">Branch Code:</th>
                                <td>{{ $bank->branch_code }}</td>
                            </tr>
                        @endif
                        @if(!empty($bank['account_no']))
                            <tr>
                                <th class="text-end ">Account #:</th>
                                <td>{{ $bank->account_no }}</td>
                            </tr>
                        @endif
                        @if(!empty($bank['iban']))
                            <tr>
                                <th class="text-end ">IBAN:</th>
                                <td>{{ $bank->iban }}</td>
                            </tr>
                        @endif
                        @if(!empty($bank['ifsc']))
                            <tr>
                                <th class="text-end ">IFSC:</th>
                                <td>{{ $bank->ifsc }}</td>
                            </tr>
                        @endif
                        @if(!empty($bank['sortcode']))
                            <tr>
                                <th class="text-end">Sort Code:</th>
                                <td>{{ $bank->sortcode }}</td>
                            </tr>
                        @endif
                    @endif
                </table>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col border   border-dark rounded p-2">
            <span
                style="position: relative;background-color: #fff;top: -25px;padding: 0px 6px;font-size: 20px;font-weight: 700;">Transaction Amounts</span>

                <h1 class="text-center">{{ $transfer->receiving_currency }} {{ number_format($transfer->receiving_amount,2) }}</h1>

                <table class="w-100" style="font-size: 12px;">
                    <tr>
                        <th class="text-end  w-50">Sending Amount:</th>
                        <td>{{ $transfer->sending_currency }} {{ number_format($transfer->sending_amount,2) }}</td>
                    </tr>
                    <tr>
                        <th class="text-end w-50">1 {{ $transfer->sending_currency }}:</th>
                        <td>{{ $transfer->receiving_currency }} {{ number_format($transfer->customer_rate,2) }}</td>
                    </tr>
                    <tr>
                        <th class="text-end w-50">Fee:</th>
                        <td>{{ $transfer->sending_currency }} {{ number_format($transfer->company_charges,2) }}</td>
                    </tr>
                    <tr>
                        <th class="text-end w-50">Total Paid:</th>
                        <td>{{ $transfer->sending_currency }} {{ number_format(($transfer->sending_amount + $transfer->company_charges),2) }}</td>
                    </tr>
                    <tr>
                        <th class="text-end w-50">Recipient gets:</th>
                        <td>{{ $transfer->receiving_currency }} {{ number_format($transfer->receiving_amount,2) }}</td>
                    </tr>
                </table>
            </div>
        </div>





    </div>
@endif
</body>
</html>
