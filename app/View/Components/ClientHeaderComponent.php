<?php

namespace App\View\Components;

use App\Models\Lang;
use App\Models\Settings;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Facades\TranslateUtility;
class ClientHeaderComponent extends Component
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
    public function render($lang = null): View|Closure|string
    {
        $url = request()->url();
        $segments = explode('/', $url);

        if (isset($segments[3]) && mb_strlen($segments[3]) < 3) {
            $lang = $segments[3];
        } else {
            $lang = Lang::where('is_default', 1)->first()->code;
        }
        $main_langs = Lang::where('status', 1)->get();
        $settings = Settings::first();
        return view('components.client-header-component', compact('lang', 'settings', 'main_langs'));
    }

}
