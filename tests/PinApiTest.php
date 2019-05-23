<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PinApiTest extends TestCase
{
    use MakePinTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePin()
    {
        $pin = $this->fakePinData();
        $this->json('POST', '/api/v1/pins', $pin);

        $this->assertApiResponse($pin);
    }

    /**
     * @test
     */
    public function testReadPin()
    {
        $pin = $this->makePin();
        $this->json('GET', '/api/v1/pins/'.$pin->id);

        $this->assertApiResponse($pin->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePin()
    {
        $pin = $this->makePin();
        $editedPin = $this->fakePinData();

        $this->json('PUT', '/api/v1/pins/'.$pin->id, $editedPin);

        $this->assertApiResponse($editedPin);
    }

    /**
     * @test
     */
    public function testDeletePin()
    {
        $pin = $this->makePin();
        $this->json('DELETE', '/api/v1/pins/'.$pin->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/pins/'.$pin->id);

        $this->assertResponseStatus(404);
    }
}
