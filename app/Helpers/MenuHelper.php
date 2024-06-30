<?php

namespace App\Helpers;

use App\Models\Menu;
use App\Services\Parameters\ParameterService;

class MenuHelper
{
    public $lang;
    public function __construct(public ParameterService $parameterService) {
        $this->lang = $parameterService->getLang();
    }
    public  function getMenuSlug($code){
        $check = Menu::where('code', $code)->first();
        if($check) {
            return $check->getWithLocale($this->lang)->slug;
        }
        return '';
    }
    public  function getMenuSeo($code){
        $check = Menu::where('code', $code)->first();
        if($check) {
            return $check->getWithLocale($this->lang);
        }
        return '';
    }


       public  function getSeoInfo($code){
        $check = Menu::where('code', $code)->first();
       
        return $check;
    }
}
