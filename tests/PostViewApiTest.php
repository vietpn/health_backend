<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostViewApiTest extends TestCase
{
    use MakePostViewTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePostView()
    {
        $postView = $this->fakePostViewData();
        $this->json('POST', '/api/v1/postViews', $postView);

        $this->assertApiResponse($postView);
    }

    /**
     * @test
     */
    public function testReadPostView()
    {
        $postView = $this->makePostView();
        $this->json('GET', '/api/v1/postViews/'.$postView->id);

        $this->assertApiResponse($postView->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePostView()
    {
        $postView = $this->makePostView();
        $editedPostView = $this->fakePostViewData();

        $this->json('PUT', '/api/v1/postViews/'.$postView->id, $editedPostView);

        $this->assertApiResponse($editedPostView);
    }

    /**
     * @test
     */
    public function testDeletePostView()
    {
        $postView = $this->makePostView();
        $this->json('DELETE', '/api/v1/postViews/'.$postView->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/postViews/'.$postView->id);

        $this->assertResponseStatus(404);
    }
}
