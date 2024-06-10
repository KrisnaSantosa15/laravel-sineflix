<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function termsAndConditions()
    {

        return view('footer-links.terms-and-conditions');
    }

    public function privacyPolicy()
    {

        return view('footer-links.privacy-and-policy');
    }
}