<?php

namespace App\View\Components;

use App\Models\Lang;
use App\Repositories\LangRepository;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminHeaderComponent extends Component
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
        $main_langs = Lang::where('status', 1)->get();
        if($this->langRepository->where('code', $lang)->count() > 0) {
            return view('components.admin-header-component', compact('lang', 'main_langs'));
        } else {
            $lang = 'az';
            return view('components.admin-header-component', compact('lang', 'main_langs'));
        }
    }
}
