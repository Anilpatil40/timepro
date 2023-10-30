<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GameCard extends Component
{
    public $href;
    public $icon;
    public $header;

    public function __construct($href, $icon, $header)
    {
        $this->href = $href;
        $this->icon = $icon;
        $this->header = $header;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.game-card');
    }
}
