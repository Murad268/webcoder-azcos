<?php
namespace App\Helpers;

use App\Models\MenuTranslates;

class LangRouteHelper
{
    protected $languageSegmentPosition = 3;
    protected $slugSegmentPosition = 4;

    public function changeLanguage($currentLang, $nextLang)
    {
        $urlSegments = $this->getUrlSegments();
        $queryParams = request()->query();

        if ($this->isCurrentLanguage($urlSegments, $currentLang)) {
            if ($this->isSearchRoute($urlSegments)) {
                $urlSegments[$this->languageSegmentPosition] = $nextLang;
            } else {
                $urlSegments = $this->translateSlug($urlSegments, $nextLang);
            }
        } else {
            $urlSegments = $this->insertLanguageSegment($urlSegments, $nextLang);
        }

        return $this->buildUrl($urlSegments, $queryParams);
    }

    public function changeLanguageInAdmin($lang, $nextLang)
    {
        $urlSegments = $this->getUrlSegments();
        $queryParams = request()->query();

        if ($this->isCurrentLanguageInAdmin($urlSegments, $lang)) {
            $urlSegments[4] = $nextLang;
        } else {
            array_splice($urlSegments, 4, 0, $nextLang);
        }

        return $this->buildUrl($urlSegments, $queryParams);
    }

    protected function getUrlSegments()
    {
        return explode('/', request()->url());
    }

    protected function isCurrentLanguage($urlSegments, $currentLang)
    {
        return isset($urlSegments[$this->languageSegmentPosition]) && $urlSegments[$this->languageSegmentPosition] === $currentLang;
    }

    protected function isCurrentLanguageInAdmin($urlSegments, $lang)
    {
        return isset($urlSegments[4]) && $urlSegments[4] === $lang;
    }

    protected function isSearchRoute($urlSegments)
    {
        return isset($urlSegments[$this->slugSegmentPosition]) && $urlSegments[$this->slugSegmentPosition] === 'axtar%C4%B1%C5%9F';
    }

    protected function translateSlug($urlSegments, $nextLang)
    {
        try {
            $menuTranslate = MenuTranslates::where('slug', $urlSegments[$this->slugSegmentPosition])->first()->translate;
            $translatedSlug = $menuTranslate->getWithLocale($nextLang)->slug;

            $urlSegments[$this->languageSegmentPosition] = $nextLang;
            $urlSegments[$this->slugSegmentPosition] = $translatedSlug;
        } catch (\Exception $e) {
            $urlSegments[$this->languageSegmentPosition] = $nextLang;
        }

        return $urlSegments;
    }

    protected function insertLanguageSegment($urlSegments, $nextLang)
    {
        array_splice($urlSegments, $this->languageSegmentPosition, 0, $nextLang);
        return $urlSegments;
    }

    protected function buildUrl($urlSegments, $queryParams)
    {
        $newUrl = implode('/', $urlSegments);

        if (!empty($queryParams)) {
            $newUrl .= '?' . http_build_query($queryParams);
        }

        return $newUrl;
    }
}
