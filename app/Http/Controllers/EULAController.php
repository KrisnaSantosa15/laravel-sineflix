<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EULAController extends Controller
{
    public function eula()
    {
        return view ('footer-links.eula');
    }
}