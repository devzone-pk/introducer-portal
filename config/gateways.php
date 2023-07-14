<?php


return [
    'trust-payment' => [
        'key' => env('TRUSTPAYMENT_KEY', '60-95500fd7fe4c1c2783ebf66de6084b86fbde620a4b1dff2fa0181786b6ee0327'),
        'iss' => env('TRUSTPAYMENT_ISS', 'jwt@rozeint.co.uk'),
        'sitereference' => env('TRUSTPAYMENT_SITE_REF', 'test_rozrint116031')
    ]
];
