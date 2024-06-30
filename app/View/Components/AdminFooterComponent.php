<?php

namespace App\View\Components;

use Closure;
use App\Repositories\LangRepository;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminFooterComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public LangRepository $langRepository)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $lang = explode('/', request()->url())[4];
        return view('components.admin-footer-component', compact('lang'));
    }
}
