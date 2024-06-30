<?php

namespace App\Helpers;

use App\Facades\TranslateUtility;
use App\Services\Parameters\ParameterService;
use Illuminate\Support\Facades\Redirect;

class RouteHelpers {

    private static $instance = null;
    private $parameterService;
    public $lang;

    private function __construct(ParameterService $parameterService)
    {
        $this->parameterService = $parameterService;
        $this->lang = $this->parameterService->getLang();
    }

    public static function getInstance(ParameterService $parameterService)
    {
        if (self::$instance == null) {
            self::$instance = new RouteHelpers($parameterService);
        }

        return self::$instance;
    }
    public function getLang()
    {
        $lang = self::getInstance(app(ParameterService::class))->lang;
        return $lang;
    }
    public static function success_create($q, $page=null)
    {
        $lang = self::getInstance(app(ParameterService::class))->lang;
        return redirect()->route("admin.".$q.".index", ['lang' => $lang, 'page' => $page])->with('success', TranslateUtility::getTranslate('response', 'success_create', $lang));
    }
    public static function error_create($q, $error, $page=null)
    {
        $lang = self::getInstance(app(ParameterService::class))->lang;
        return redirect()->route("admin.".$q.".index", ['lang' => $lang, 'page' => $page])->with('error', TranslateUtility::getTranslate('response', 'error_create', $lang, $error));
    }




    public static function success_update($q, $page = null)
    {
        $lang = self::getInstance(app(ParameterService::class))->lang;
        if($page) {
            return redirect()->route("admin.".$q.".index", ['lang' => $lang, 'page' => $page])->with('success', TranslateUtility::getTranslate('response', 'success_update', $lang));
        } else {
            return redirect()->route("admin.".$q.".index", ['lang' => $lang])->with('success', TranslateUtility::getTranslate('response', 'success_update', $lang));
        }
    }

    public static function error_update($q, $error, $page = null)
    {
        $lang = self::getInstance(app(ParameterService::class))->lang;
        if($page) {
            return redirect()->route("admin.".$q.".index", ['lang' => $lang, 'page' => $page])->with('error', TranslateUtility::getTranslate('response', 'error_update', $lang, $error));
        } else {
            return redirect()->route("admin.".$q.".index", ['lang' => $lang, 'page' => $page])->with('error', TranslateUtility::getTranslate('response', 'error_update', $lang, $error));
        }
    }







    public static function success_delete($q, $page = null)
    {
        $lang = self::getInstance(app(ParameterService::class))->lang;
        return redirect()->route("admin.".$q.".index", ['lang' => $lang, 'page' => $page])->with('success', TranslateUtility::getTranslate('response', 'success_delete', $lang));
    }
    public static function error_delete($q, $error, $page = null)
    {
        $lang = self::getInstance(app(ParameterService::class))->lang;
        return redirect()->route("admin.".$q.".index", ['lang' => $lang, 'page' => $page])->with('error', TranslateUtility::getTranslate('response', 'error_delete', $lang, $error));
    }







    public static function success_update_response($q)
    {
        $lang = self::getInstance(app(ParameterService::class))->lang;
        return response(['success' => TranslateUtility::getTranslate('response', 'success_update', $lang)]);
    }
    public static function error_delete_response($q, $error)
    {
        $lang = self::getInstance(app(ParameterService::class))->lang;
        return response(['success' => TranslateUtility::getTranslate('response', 'error_delete', $lang, $error)]);
    }







}
