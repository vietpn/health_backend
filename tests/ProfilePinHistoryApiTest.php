<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProfilePinHistoryApiTest extends TestCase
{
    use MakeProfilePinHistoryTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateProfilePinHistory()
    {
        $profilePinHistory = $this->fakeProfilePinHistoryData();
        $this->json('POST', '/api/v1/profilePinHistories', $profilePinHistory);

        $this->assertApiResponse($profilePinHistory);
    }

    /**
     * @test
     */
    public function testReadProfilePinHistory()
    {
        $profilePinHistory = $this->makeProfilePinHistory();
        $this->json('GET', '/api/v1/profilePinHistories/'.$profilePinHistory->id);

        $this->assertApiResponse($profilePinHistory->toArray());
    }

    /**
     * @test
     */
    public function testUpdateProfilePinHistory()
    {
        $profilePinHistory = $this->makeProfilePinHistory();
        $editedProfilePinHistory = $this->fakeProfilePinHistoryData();

        $this->json('PUT', '/api/v1/profilePinHistories/'.$profilePinHistory->id, $editedProfilePinHistory);

        $this->assertApiResponse($editedProfilePinHistory);
    }

    /**
     * @test
     */
    public function testDeleteProfilePinHistory()
    {
        $profilePinHistory = $this->makeProfilePinHistory();
        $this->json('DELETE', '/api/v1/profilePinHistories/'.$profilePinHistory->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/profilePinHistories/'.$profilePinHistory->id);

        $this->assertResponseStatus(404);
    }
}
