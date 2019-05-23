<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BussinesTypeApiTest extends TestCase
{
    use MakeBussinesTypeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateBussinesType()
    {
        $bussinesType = $this->fakeBussinesTypeData();
        $this->json('POST', '/api/v1/bussinesTypes', $bussinesType);

        $this->assertApiResponse($bussinesType);
    }

    /**
     * @test
     */
    public function testReadBussinesType()
    {
        $bussinesType = $this->makeBussinesType();
        $this->json('GET', '/api/v1/bussinesTypes/'.$bussinesType->id);

        $this->assertApiResponse($bussinesType->toArray());
    }

    /**
     * @test
     */
    public function testUpdateBussinesType()
    {
        $bussinesType = $this->makeBussinesType();
        $editedBussinesType = $this->fakeBussinesTypeData();

        $this->json('PUT', '/api/v1/bussinesTypes/'.$bussinesType->id, $editedBussinesType);

        $this->assertApiResponse($editedBussinesType);
    }

    /**
     * @test
     */
    public function testDeleteBussinesType()
    {
        $bussinesType = $this->makeBussinesType();
        $this->json('DELETE', '/api/v1/bussinesTypes/'.$bussinesType->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/bussinesTypes/'.$bussinesType->id);

        $this->assertResponseStatus(404);
    }
}
