<?php

use App\Models\PostCommentLike;
use App\Repositories\PostCommentLikeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostCommentLikeRepositoryTest extends TestCase
{
    use MakePostCommentLikeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PostCommentLikeRepository
     */
    protected $postCommentLikeRepo;

    public function setUp()
    {
        parent::setUp();
        $this->postCommentLikeRepo = App::make(PostCommentLikeRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePostCommentLike()
    {
        $postCommentLike = $this->fakePostCommentLikeData();
        $createdPostCommentLike = $this->postCommentLikeRepo->create($postCommentLike);
        $createdPostCommentLike = $createdPostCommentLike->toArray();
        $this->assertArrayHasKey('id', $createdPostCommentLike);
        $this->assertNotNull($createdPostCommentLike['id'], 'Created PostCommentLike must have id specified');
        $this->assertNotNull(PostCommentLike::find($createdPostCommentLike['id']), 'PostCommentLike with given id must be in DB');
        $this->assertModelData($postCommentLike, $createdPostCommentLike);
    }

    /**
     * @test read
     */
    public function testReadPostCommentLike()
    {
        $postCommentLike = $this->makePostCommentLike();
        $dbPostCommentLike = $this->postCommentLikeRepo->find($postCommentLike->id);
        $dbPostCommentLike = $dbPostCommentLike->toArray();
        $this->assertModelData($postCommentLike->toArray(), $dbPostCommentLike);
    }

    /**
     * @test update
     */
    public function testUpdatePostCommentLike()
    {
        $postCommentLike = $this->makePostCommentLike();
        $fakePostCommentLike = $this->fakePostCommentLikeData();
        $updatedPostCommentLike = $this->postCommentLikeRepo->update($fakePostCommentLike, $postCommentLike->id);
        $this->assertModelData($fakePostCommentLike, $updatedPostCommentLike->toArray());
        $dbPostCommentLike = $this->postCommentLikeRepo->find($postCommentLike->id);
        $this->assertModelData($fakePostCommentLike, $dbPostCommentLike->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePostCommentLike()
    {
        $postCommentLike = $this->makePostCommentLike();
        $resp = $this->postCommentLikeRepo->delete($postCommentLike->id);
        $this->assertTrue($resp);
        $this->assertNull(PostCommentLike::find($postCommentLike->id), 'PostCommentLike should not exist in DB');
    }
}
