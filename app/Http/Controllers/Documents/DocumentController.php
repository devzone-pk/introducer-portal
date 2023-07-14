<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function upload(Request $request)
    {
        \Illuminate\Support\Facades\Log::error('test');
        if ($request->hasFile('front')) {
            $file = $request->file('front');
            $path = Storage::disk('s3')->putFile('documents', $file, 'public');
            Redis::set("document.front." . session('customer_id'), $path, 'EX', 300);

        }


        if ($request->hasFile('back')) {
            $file = $request->file('back');
            $path = Storage::disk('s3')->putFile('documents', $file, 'public');
            Redis::set("document.back." . session('customer_id'), $path, 'EX', 300);
        }


    }
}
