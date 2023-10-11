<?php

namespace Tests\Unit;

use Tests\TestCase;

class MostMarketBrandsTest extends TestCase
{
    public function testGetMostBrandsQuote()
    {
        $response = $this->getJson('api/market/mostBrands');

        $response->assertStatus(200);
        $response->assertExactJson(['status' => true]);
    }

}
