<?php

namespace App\View\Components\Client;

use Illuminate\View\Component;

class Campaign extends Component
{
    public $campaign;

    public function __construct($campaign)
    {
        $this->campaign = $campaign;
    }

    public function render()
    {
        return view('components.campaign');
    }
}
