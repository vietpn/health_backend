<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostCommentApiTest extends TestCase
{
    use MakePostCommentTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePostComment()
    {
        $postComment = $this->fakePostCommentData();
        $this->json('POST', '/api/v1/postComments', $postComment);

        $this->assertApiResponse($postComment);
    }

    /**
     * @test
     */
    public function testReadPostComment()
    {
        $postComment = $this->makePostComment();
        $this->json('GET', '/api/v1/postComments/'.$postComment->id);

        $this->assertApiResponse($postComment->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePostComment()
    {
        $postComment = $this->makePostComment();
        $editedPostComment = $this->fakePostCommentData();

        $this->json('PUT', '/api/v1/postComments/'.$postComment->id, $editedPostComment);

        $this->assertApiResponse($editedPostComment);
    }

    /**
     * @test
     */
    public function testDeletePostComment()
    {
        $postComment = $this->makePostComment();
        $this->json('DELETE', '/api/v1/postComments/'.$postComment->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/postComments/'.$postComment->id);

        $this->assertResponseStatus(404);
    }
}
