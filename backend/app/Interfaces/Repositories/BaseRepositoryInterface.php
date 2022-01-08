<?php

namespace Modules\MemberDashboard\Interfaces\Repositories;

interface BaseRepositoryInterface
{
    public function create($request);
    public function update($modelId, $request);
    public function findById($modelId);
    public function findOrFail($modelId);
    public function all();
    public function first();
    public function delete($id);
    public function updateByField($field, $fieldValue, $data);
    public function updateOrCreate($existingData, $updateData);
}
