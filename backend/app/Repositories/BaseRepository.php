<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create($request): Model
    {
        return $this->model->create($request);
    }

    public function update($modelId, $request)
    {
        return $this->findById($modelId)->update($request);
    }

    public function findById($modelId): ?Model
    {
        return $this->model->find($modelId);
    }

    public function findOrFail($modelId): ?Model
    {
        return $this->model->findOrFail($modelId);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function first()
    {
        return $this->model->first();
    }

    public function delete($id)
    {
        return $this->findById($id)->delete();
    }

    public function updateByField($field, $fieldValue, $data)
    {
        return $this->model->where($field, $fieldValue)->update($data);
    }

    public function updateOrCreate($existingData, $updateData)
    {
        return $this->model->updateOrCreate($existingData, $updateData);
    }
}
