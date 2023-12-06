<?php

use App\Http\Middleware\RedirectToDashboard;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['auth.allow'])->group(function () {

    Route::get('/dashboard', function () {
        return view('inner.dashboard');
    });
    Route::get('/send/money', function () {
        return view('inner.send-money');
    });
    Route::get('/transfer/success', function () {
        return view('inner.send-money-success');
    });
    Route::get('/transfer/history', function () {
        return view('inner.transfer-history');
    });
    Route::get('/transfer/history/{id}', function ($id) {
        return view('inner.transfer-history-detail', compact('id'));
    });

    Route::get('/recipients', function () {
        return view('inner.recipients');
    });

    Route::get('/recipients/add', function () {
        return view('inner.add-recipients');
    });

    Route::get('/recipients/view/{id}', function () {
        return view('inner.view-recipients');
    });
    Route::get('/profile', function () {
        return view('inner.profile');
    })->name('profile');
    Route::get('/customer-support', function () {
        return view('inner.customer-support');
    });

    Route::get('/customer-support/details/{id}', function ($id) {
        return view('inner.customer-support-details', compact('id'));
    });
    Route::get('/customer-support/add-complaint', function () {
        return view('inner.add-complaint');
    });
    Route::get('contact-preferences', function () {
        return view('inner.customer-preferences');
    });
    Route::get('refer-friend', function () {
        return view('inner.refer-friend');
    });
    Route::get('user/documents', function () {
        return view('inner.documents');
    });
    Route::get('user/document/add', function () {
        return view('inner.document-add');
    });
    Route::get('user/document/view/{id}', function ($id) {
        return view('inner.view-document', compact('id'));
    });

    Route::get('receipt', function () {
        $input = request();
        $transfer = \App\Models\Transfer\Transfer::find($input['transfer_id']);
        return view('receipt-pdf', compact('transfer'));

    });

    Route::get('logout', [\App\Http\Controllers\Auth\LogoutController::class, 'logout']);

    //mobile screens
    Route::get('mobile/send/money', function () {
        return view('mobile.send-money');
    });

    Route::get('mobile/transfer/success', function () {
        return view('mobile.send-money-success');
    });


    Route::get('mobile/dashboard', function () {
        return view('mobile.dashboard');
    });
    Route::get('mobile/transactions', function () {
        return view('mobile.transfer-history');
    });
    Route::get('mobile/transaction/{id}', function ($id) {
        return view('mobile.transfer-details', compact('id'));
    });
    Route::get('mobile/receivers', function () {
        return view('mobile.recipients');
    });
    Route::get('mobile/receivers/add', function () {
        return view('mobile.recipient-add');
    });
    Route::get('mobile/receiver/{id}', function ($id) {
        return view('mobile.recipient-detail', compact('id'));
    });
    Route::get('mobile/account', function () {
        return view('mobile.account-setting');
    });
    Route::get('mobile/profile-view', function () {
        return view('mobile.profile-view');
    });

    Route::get('mobile/profile', function () {
        return view('mobile.profile');
    });


    Route::get('mobile/address-view', function () {
        return view('mobile.user-address-view');
    });
    Route::get('mobile/address', function () {
        return view('mobile.user-address');
    });
    Route::get('mobile/contact', function () {
        return view('mobile.contact');
    });
    Route::get('mobile/contact-preferences', function () {
        return view('mobile.customer-preferences');
    });
    Route::get('mobile/faqs', function () {
        return view('mobile.faqs');
    }); //TODO text need to update

    Route::get('mobile/terms-conditions', function () {
        return view('mobile.terms-conditions');
    });
//
    Route::get('mobile/password-view', function () {
        return view('mobile.change-password-view');
    });

    Route::get('mobile/change-password', function () {
        return view('mobile.change-password');
    });
    Route::get('mobile/contact-preferences', function () {
        return view('mobile.customer-preferences');
    });
    Route::get('mobile/privacy-policy', function () {
        return view('mobile.privacy-policy');
    });
    Route::get('mobile/refer-friend', function () {
        return view('mobile.refer-friend');
    }); //TODO share and copy need to update.

    Route::get('mobile/documents', function () {
        return view('mobile.documents');
    });
    Route::get('mobile/document/add', function () {
        return view('mobile.document-add');
    });

    Route::get('mobile/document/view/{id}', function ($id) {
        return view('mobile.document-view', compact('id'));
    });

    Route::get('mobile/customer-support', function () {
        return view('mobile.customer-support');
    });

    Route::get('mobile/customer-support/add', function () {
        return view('mobile.customer-support-add');
    });

    Route::get('mobile/customer-support/details/{id}', function ($id) {
        return view('mobile.customer-support-details', compact('id'));
    });

    Route::post('upload/documents', [\App\Http\Controllers\Documents\DocumentController::class, 'upload']);
    //Trust Payments Routes
    Route::get('gateway/trust/payment/{transfer_code}', [\App\Http\Controllers\Gateways\TrustPaymentController::class, 'index']);
    Route::post('gateway/trust/payment/response', [\App\Http\Controllers\Gateways\TrustPaymentController::class, 'response']);

    Route::get('gateway/swipen/payment/{transfer_code}', [\App\Http\Controllers\Gateways\SwipenController::class, 'index']);

});
//Route::post('gateway/swipen/payment/{token}', [\App\Http\Controllers\Gateways\SwipenController::class, 'response']);

Route::middleware(RedirectToDashboard::class)->group(function () {
    Route::get('/login', function () {
        return redirect('/');
    });
//    Route::get('/register', function () {
//        return view('register');
//    });
});
Route::get('user/track-transfer', function () {
    return view('mobile.track-transfer');
});
Route::get('user/calculator', function () {
    return view('mobile.calculator');
});
Route::get('user/signup', function () {
    return view('mobile.signup');
});
Route::get('user/login', function () {
    return '';
});
Route::get('forgot/password/{token}', function ($token) {
    return view('outer.forgot-password', compact('token'));
});


Route::get('/', function () {
    $countries = \App\Models\Country\Country::select('name')->where('is_on_receiving', 't')->get();
    return view('outer.index', compact('countries'));
})->name('index');
Route::view('account/delete/request', 'outer.delete');

Route::get('send-money-to/{iso2}', function ($iso2) {
    return view('outer.country', compact('iso2'));
});

Route::view('about', 'outer.about-us')->name('about-us');
Route::view('how-it-works', 'outer.how-it-works')->name('how-it-works');
Route::view('faqs', 'outer.help')->name('help');
Route::view('contact-us', 'outer.contact-us')->name('contact-us');
Route::view('sign-up', 'outer.sign-up')->name('register');
Route::view('sign-in', 'outer.sign-in')->name('login');
Route::get('verify/{id}/{email}', function ($id, $email) {
    return view('outer.verify', compact('id', 'email'));
});

Route::get('mobile/app', function () {
    $device = \Jenssegers\Agent\Facades\Agent::device();
    if (in_array($device, ['iPhone', 'iPad'])) {
        return redirect('https://apps.apple.com/us/app/orium-global-resources/id6463112338');
    }
    return redirect('https://play.google.com/store/apps/details?id=com.oriumglobal.resources');

});

//Route::view('forgot-password', 'outer.forgot-password-request');


//Route::middleware(\App\Http\Middleware\SiteDown::class)->group(function () {
//
//
//});

Route::view('terms-and-conditions', 'outer.terms-and-conditions')->name('terms-and-conditions');
Route::view('privacy-policy', 'outer.privacy-policy')->name('privacy-policy');
//Route::view('refund-policy', 'outer.refund-policy')->name('refund-policy');
Route::view('anti-fraud-policy', 'outer.anti-fraud-policy')->name('anti-fraud-policy');
Route::view('gdpr-policy', 'outer.gdpr-policy')->name('gdpr-policy');
Route::view('refer-friend', 'outer.refer-friend')->name('refer-friend');




