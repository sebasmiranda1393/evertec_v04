<?php

namespace App\Http\Controllers;

use App\RedirectRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlaceToPayController extends Controller
{
    /**
     * Payment ()
     *
     * @param RedirectRequest $request
     * @return RedirectResponse [RedirectResponse] response
     */
    public function payment(RedirectRequest $request)
    {
        $request->Amount([
            '$currency' => 'required|string|email',
            '$total' => 'required|string',
            'remember_me' => 'boolean'
        ]);
    }
}
