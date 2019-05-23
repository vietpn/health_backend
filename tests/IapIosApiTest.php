<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class IapIosApiTest extends TestCase
{
    use MakeIapIosTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateIapIos()
    {
        $iapIos = $this->fakeIapIosData();
        $this->json('POST', '/api/v1/iapIos', $iapIos);

        $this->assertApiResponse($iapIos);
    }

    /**
     * @test
     */
    public function testReadIapIos()
    {
        $iapIos = $this->makeIapIos();
        $this->json('GET', '/api/v1/iapIos/'.$iapIos->id);

        $this->assertApiResponse($iapIos->toArray());
    }

    /**
     * @test
     */
    public function testUpdateIapIos()
    {
        $iapIos = $this->makeIapIos();
        $editedIapIos = $this->fakeIapIosData();

        $this->json('PUT', '/api/v1/iapIos/'.$iapIos->id, $editedIapIos);

        $this->assertApiResponse($editedIapIos);
    }

    /**
     * @test
     */
    public function testDeleteIapIos()
    {
        $iapIos = $this->makeIapIos();
        $this->json('DELETE', '/api/v1/iapIos/'.$iapIos->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/iapIos/'.$iapIos->id);

        $this->assertResponseStatus(404);
    }
}
