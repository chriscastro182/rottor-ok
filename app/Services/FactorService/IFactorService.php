<?php

namespace App\Services\FactorService;

interface IFactorService
{
	public function getCalcValue($km, $motor, $cc);
}
