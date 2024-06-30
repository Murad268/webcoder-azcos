<?php

namespace App\Services;



class TranslateService
{

    public function simple_create($translates, $translates_translates, $request) {
        $data = ['group' => $request->group, 'code' => $request->code];
        $translate = $translates::create($data);

        foreach($request->locale as $key => $value) {
            $translates_translates::create(['translate_id' => $translate->id, 'locale' => $key, 'value' => $value]);
        }
    }

    public function simple_update($translates_translates, $model, $request)
    {
        $translate = $model;
        if (!$translate) {
            throw new \Exception("Translate not found");
        }

        // Update the main translate record
        $translate->update(['group' => $request->group, 'code' => $request->code]);

        // Loop through the locales and update or create translate translations
        foreach ($request->locale as $key => $value) {
            $translate_translation = $translates_translates::where('translate_id', $translate->id)
                ->where('locale', $key)
                ->first();

            if ($translate_translation) {
                // Update existing translation
                $translate_translation->update(['value' => $value]);
            } else {
                // Create new translation
                $translates_translates::create(['translate_id' => $translate->id, 'locale' => $key, 'value' => $value]);
            }
        }
    }
    public function deleteWhereIn($models)
    {
        foreach ($models as $model) {
            $model->delete();
        }
    }
}
