<?php

namespace App\Services;

class NumberService
{
    public function changeDefault($model, $modelAll)
    {
        $modelAll::query()->update(['is_default' => false]);
        $model->update(['is_default' => true]);
    }

    public function changeStatusTrue($model)
    {
        $model->update(['status' => true]);
    }

    public function changeStatusFalse($model)
    {
        $model->update(['status' => false]);
    }


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
