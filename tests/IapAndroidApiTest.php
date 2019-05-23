<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class IapAndroidApiTest extends TestCase
{
    use MakeIapAndroidTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateIapAndroid()
    {
        $iapAndroid = $this->fakeIapAndroidData();
        $this->json('POST', '/api/v1/iapAndroids', $iapAndroid);

        $this->assertApiResponse($iapAndroid);
    }

    /**
     * @test
     */
    public function testReadIapAndroid()
    {
        $iapAndroid = $this->makeIapAndroid();
        $this->json('GET', '/api/v1/iapAndroids/'.$iapAndroid->id);

        $this->assertApiResponse($iapAndroid->toArray());
    }

    /**
     * @test
     */
    public function testUpdateIapAndroid()
    {
        $iapAndroid = $this->makeIapAndroid();
        $editedIapAndroid = $this->fakeIapAndroidData();

        $this->json('PUT', '/api/v1/iapAndroids/'.$iapAndroid->id, $editedIapAndroid);

        $this->assertApiResponse($editedIapAndroid);
    }

    /**
     * @test
     */
    public function testDeleteIapAndroid()
    {
        $iapAndroid = $this->makeIapAndroid();
        $this->json('DELETE', '/api/v1/iapAndroids/'.$iapAndroid->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/iapAndroids/'.$iapAndroid->id);

        $this->assertResponseStatus(404);
    }
}
