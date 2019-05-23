<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostCommentLikeApiTest extends TestCase
{
    use MakePostCommentLikeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePostCommentLike()
    {
        $postCommentLike = $this->fakePostCommentLikeData();
        $this->json('POST', '/api/v1/postCommentLikes', $postCommentLike);

        $this->assertApiResponse($postCommentLike);
    }

    /**
     * @test
     */
    public function testReadPostCommentLike()
    {
        $postCommentLike = $this->makePostCommentLike();
        $this->json('GET', '/api/v1/postCommentLikes/'.$postCommentLike->id);

        $this->assertApiResponse($postCommentLike->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePostCommentLike()
    {
        $postCommentLike = $this->makePostCommentLike();
        $editedPostCommentLike = $this->fakePostCommentLikeData();

        $this->json('PUT', '/api/v1/postCommentLikes/'.$postCommentLike->id, $editedPostCommentLike);

        $this->assertApiResponse($editedPostCommentLike);
    }

    /**
     * @test
     */
    public function testDeletePostCommentLike()
    {
        $postCommentLike = $this->makePostCommentLike();
        $this->json('DELETE', '/api/v1/postCommentLikes/'.$postCommentLike->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/postCommentLikes/'.$postCommentLike->id);

        $this->assertResponseStatus(404);
    }
}
