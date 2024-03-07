<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminApproveCOntroller extends Controller
{
    public function blockMessage()
    {
        return view('layouts.block_message');
    }
}
