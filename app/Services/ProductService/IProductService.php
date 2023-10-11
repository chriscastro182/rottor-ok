<?php

namespace App\Services\ProductService;

interface IProductService
{
    public function filter(array $data, int $paginate);
}
