<?php

namespace App\View\Components;

use App\Models\Settings;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MetaComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $settings = Settings::first();
        return view('components.meta-component', compact('settings'));
    }
}
