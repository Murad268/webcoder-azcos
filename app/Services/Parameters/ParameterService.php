<?php

namespace App\Services\Parameters;

use App\Models\Lang;
use Illuminate\Support\Facades\Storage;

class ParameterService
{
    public function getLang() {
        $url = request()->url($lang = null);
        $segments = explode('/', $url);

        if (isset($segments[3]) && mb_strlen($segments[3]) < 3) {
            $lang = $segments[3];
        } else {
            $lang = Lang::where('is_default', 1)->first()->code;
        }
        return $lang;
    }
}
