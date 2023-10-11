<?php

namespace App\Services\BaseService;

interface IBaseService
{
	public function create(array $data);
	public function update(array $data, int $id);
	public function delete(int $id);
	public function get(int $id);
	public function all();
	public function paginate(int $page);
}
