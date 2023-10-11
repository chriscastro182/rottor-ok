<?php

namespace App\Services\BaseService;

use App\Models\Model;

class AbstractBaseService implements IBaseService
{
    protected $model;

    public function create(array $data)
    {
        // TODO: Implement create() method.
    }

    public function update(array $data, int $id)
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }

    public function get(int $id)
    {
        // TODO: Implement get() method.
    }

    public function all()
    {
        // TODO: Implement all() method.
    }

    public function paginate(int $page)
    {
        // TODO: Implement paginate() method.
    }

    public function setModel(Model $model)
    {
        $this->model = $model;
    }
}