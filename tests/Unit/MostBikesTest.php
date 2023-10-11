<?php

namespace Tests\Unit;

use Tests\TestCase;

class MostBikesTest extends TestCase
{
    public function testGetMostBikesQuotation()
    {
        $response = $this->getJson('/api/customMarket/getMostBikes');

        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
    }
}
