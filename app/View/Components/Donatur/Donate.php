<?php

namespace App\View\Components\Donatur;

use Illuminate\View\Component;

class Donate extends Component
{
    public $transaction;

    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }

    public function render()
    {
        return view('components.donatur.donate');
    }
}
