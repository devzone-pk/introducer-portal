<p>
    Team,

    <br>
    Please be informed that a payment follow-up has been initiated by the customer.
    <br><br>
    Details:<br>
    Payment No: {{ $transfer['transfer_code'] }}
    Amount: {{ $transfer['sending_currency'] }} {{ number_format($transfer['sending_amount'] + $transfer['company_charges']) }}
    <br>
    Your prompt attention to resolving this matter is appreciated.

</p>