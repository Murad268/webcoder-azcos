<?php

namespace App\Helpers;

use App\Models\Lang;
use App\Models\Translates;
use App\Models\TranslatesTranslates;
use App\Services\Parameters\ParameterService;

class TranslateUtilityHelper
{
    public $lang;
    public function __construct() {
        $parameterService = new ParameterService();

        $this->lang = $parameterService->getLang();
    }
    public function getTranslate($group, $code, $lang, $error = null)
    {
        $check = Translates::where('group', $group)->where('code', $code)->first();
        if($check) {
            $debug = env('APP_DEBUG');
            if($debug) {
                $errorMessage = $error;
            } else {
                $errorMessage = '';
            }
            return $check->getWithLocale($lang).' '.$errorMessage;
        } else {
            $create_translate = Translates::create(['group' => $group, 'code' => $code]);
            $langs = Lang::where('status', 1)->get();
            foreach ($langs as $lang) {
                TranslatesTranslates::create(['translate_id' => $create_translate->id, 'value' => $group.'.'.$code, 'locale' => $lang->code]);
            }
            return $group.'.'.$code;
        }


    }

    public function getLang()
    {
        return $this->lang;
          
    }
}
