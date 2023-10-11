<?php

namespace App\Services\ModelService;

interface IModelService
{
	public function byBrand($brand_id, $year);

    public function getVersions($model_id);
}
