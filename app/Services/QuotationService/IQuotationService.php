<?php

namespace App\Services\QuotationService;

interface IQuotationService
{
    public function quotateMarkets($markets, $extra_data);

    public function quotateMarket($market_data, $extra_data);

    public function getMostBrands();

    public function getLessBrands();

    public function getMostVersions();

    public function getLessVersions();

    public function getMostCC();

    public function getLessCC();
}
