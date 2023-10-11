<?php

namespace Tests\Unit;

use Tests\TestCase;

class QuoteBrandsTest extends TestCase
{
/*
    public function testGetMostBrands()
    {
        //$response = $this->getJson('api/quotation/mostBrands');

        //$response->assertStatus(200);
        //$response->assertExactJson(['status' => true]);
    }*/

    public function testLessBrands()
    {

        $response = $this->getJson('api/quotation/lessBrands');

        $response->assertStatus(200);
        $response->assertExactJson(['status' => true]);
    }
}
