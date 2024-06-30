<?php

namespace App\Services;

class SocialService
{




    public function simple_create($model, $data)
    {
        $model::create($data);
    }

    public function simple_update($model, $data)
    {
        $model->update($data);
    }

    public function deleteWhereIn($models)
    {
        foreach ($models as $model) {
            $model->delete();
        }
    }

    public function changeOrder($datas, $repo)
    {
        foreach ($datas as $data) {
            $lang = $repo->find($data['id']);
            $lang->update(['order' => $data['order']]);
        }
    }
}
