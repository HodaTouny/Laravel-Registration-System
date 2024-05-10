<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
class LocaleController extends Controller
{
    public function setLocale($lang): \Illuminate\Http\RedirectResponse
    {
        if(in_array($lang, ['ar','en'])){
            App::setLocale($lang);
            Session::put('locale', $lang);
        }
        return back();
    }

}
