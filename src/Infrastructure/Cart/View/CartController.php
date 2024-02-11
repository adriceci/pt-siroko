<?php

namespace Siroko\Infrastructure\Cart\View;

use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function __invoke()
    {
        return view('cart');
    }
}
