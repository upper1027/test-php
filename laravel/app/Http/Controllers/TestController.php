<?php

namespace App\Http\Controllers;

use App\Jobs\CloseOrder;

class TestController extends Controller
{
    public function index()
    {
        $this->dispatch(new CloseOrder(1));
        $this->dispatch(new CloseOrder(0));
        return true;
    }
}
