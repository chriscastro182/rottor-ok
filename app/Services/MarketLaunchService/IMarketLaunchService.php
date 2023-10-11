<?php

namespace App\Services\MarketLaunchService;

interface IMarketLaunchService
{
	public function getCotization($data);

    public function getMostBrandsQuote();

    public function getLessBrandsQuote();
}
