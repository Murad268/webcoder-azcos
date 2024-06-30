<?php

namespace App\View\Components;

use App\Models\Lang;
use App\Models\Settings;
use App\Models\Social;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FrontFooterComponent extends Component
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
        $url = request()->url($lang = null);
        $segments = explode('/', $url);

        if (isset($segments[3]) && mb_strlen($segments[3]) < 3) {
            $lang = $segments[3];
        } else {
            $lang = Lang::where('is_default', 1)->first()->code;
        }
        $settings = Settings::first();
        $socials = Social::first();
        return view('components.front-footer-component', compact('lang', 'settings', 'socials'));
    }
}
