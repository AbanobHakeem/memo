<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class HomeController extends Controller
{
    public function index()
    {
        $array = [];
        $content = json_decode(file_get_contents(base_path('lang/en.json')), true);
        foreach ($content as $key => $value)
            $array[$key] = "";
        $content = json_encode($array);
        file_put_contents(base_path('lang/temp.json'), $content);

        return view('frontend.pages.index');
    }
}
