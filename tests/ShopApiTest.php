<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShopApiTest extends TestCase
{
    use MakeShopTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateShop()
    {
        $shop = $this->fakeShopData();
        $this->json('POST', '/api/v1/shops', $shop);

        $this->assertApiResponse($shop);
    }

    /**
     * @test
     */
    public function testReadShop()
    {
        $shop = $this->makeShop();
        $this->json('GET', '/api/v1/shops/'.$shop->id);

        $this->assertApiResponse($shop->toArray());
    }

    /**
     * @test
     */
    public function testUpdateShop()
    {
        $shop = $this->makeShop();
        $editedShop = $this->fakeShopData();

        $this->json('PUT', '/api/v1/shops/'.$shop->id, $editedShop);

        $this->assertApiResponse($editedShop);
    }

    /**
     * @test
     */
    public function testDeleteShop()
    {
        $shop = $this->makeShop();
        $this->json('DELETE', '/api/v1/shops/'.$shop->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/shops/'.$shop->id);

        $this->assertResponseStatus(404);
    }
}
