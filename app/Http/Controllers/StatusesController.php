<?php

namespace App\Http\Controllers;

use App\Http\Status;

class StatusesController extends Controller
{
    /**
     *
     */
    public function store()
    {
        Status::create([
            'body'=>request('body'),
            'user_id' => auth()->id()
        ]);
    }
}
