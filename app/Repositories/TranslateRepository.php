<?php

namespace App\Repositories;

use App\Models\Translates;
use App\Models\TranslatesTranslates;

class TranslateRepository
{
    protected $modelClassTranslates = Translates::class;
    protected $modelClassTranslatesTranslates = TranslatesTranslates::class;


    public function whereLocale($locale, $p)
    {
        return $this->modelClassTranslatesTranslates::where('locale', $locale)
            ->join('translates', 'translates.id', '=', 'translates_translates.translate_id')
            ->orderBy('translates.group')
            ->select('translates_translates.*') // Ensure you select the correct columns
            ->paginate($p);
    }

    public function getClassTranslates()
    {
        return $this->modelClassTranslates;
    }

    public function getClassTranslatesTranslates()
    {
        return $this->modelClassTranslatesTranslates;
    }

    public function find($id)
    {
        return $this->modelClassTranslates::findOrFail($id);
    }
    public function findWith($id, $translates)
    {
        return $this->modelClassTranslates::with($translates)->findOrFail($id);
    }
    public function findWhereInGet(array $data)
    {
        return $this->modelClassTranslates::whereIn('id', $data)->get();
    }

    public function search($q, $lang, $p)
    {
        $translateIds = $this->modelClassTranslatesTranslates::where('value', 'like', '%' . $q . '%')
            ->orWhereHas('translate', function ($query) use ($q) {
                $query->where('group', 'like', '%' . $q . '%')
                    ->orWhere('locale', 'like', '%' . $q . '%')
                    ->orWhere('code', 'like', '%' . $q . '%');
            })
            ->pluck('translate_id');

        return $this->modelClassTranslatesTranslates::whereIn('translate_id', $translateIds)
            ->where('locale', $lang)
            ->join('translates', 'translates.id', '=', 'translates_translates.translate_id')
            ->orderBy('translates.group')
            ->select('translates_translates.*') // Ensure you select the correct columns
            ->paginate($p);
    }

}
