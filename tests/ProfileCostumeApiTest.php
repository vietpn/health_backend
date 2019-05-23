<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProfileCostumeApiTest extends TestCase
{
    use MakeProfileCostumeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateProfileCostume()
    {
        $profileCostume = $this->fakeProfileCostumeData();
        $this->json('POST', '/api/v1/profileCostumes', $profileCostume);

        $this->assertApiResponse($profileCostume);
    }

    /**
     * @test
     */
    public function testReadProfileCostume()
    {
        $profileCostume = $this->makeProfileCostume();
        $this->json('GET', '/api/v1/profileCostumes/'.$profileCostume->id);

        $this->assertApiResponse($profileCostume->toArray());
    }

    /**
     * @test
     */
    public function testUpdateProfileCostume()
    {
        $profileCostume = $this->makeProfileCostume();
        $editedProfileCostume = $this->fakeProfileCostumeData();

        $this->json('PUT', '/api/v1/profileCostumes/'.$profileCostume->id, $editedProfileCostume);

        $this->assertApiResponse($editedProfileCostume);
    }

    /**
     * @test
     */
    public function testDeleteProfileCostume()
    {
        $profileCostume = $this->makeProfileCostume();
        $this->json('DELETE', '/api/v1/profileCostumes/'.$profileCostume->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/profileCostumes/'.$profileCostume->id);

        $this->assertResponseStatus(404);
    }
}
