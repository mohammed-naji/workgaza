<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductApiController extends Controller
{
    function index() {
        $data = Http::get('https://dummyjson.com/products')->json();
        // $products = Http::get('https://dummyjson.com/products')->body();

        // $products = json_decode($products, true);

        // dd($products);


        return view('api.products', compact('data'));
    }

    function weather() {
        return view('api.weather');
    }
}
