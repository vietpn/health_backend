<?php

use App\Models\PostComment;
use App\Repositories\PostCommentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostCommentRepositoryTest extends TestCase
{
    use MakePostCommentTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PostCommentRepository
     */
    protected $postCommentRepo;

    public function setUp()
    {
        parent::setUp();
        $this->postCommentRepo = App::make(PostCommentRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePostComment()
    {
        $postComment = $this->fakePostCommentData();
        $createdPostComment = $this->postCommentRepo->create($postComment);
        $createdPostComment = $createdPostComment->toArray();
        $this->assertArrayHasKey('id', $createdPostComment);
        $this->assertNotNull($createdPostComment['id'], 'Created PostComment must have id specified');
        $this->assertNotNull(PostComment::find($createdPostComment['id']), 'PostComment with given id must be in DB');
        $this->assertModelData($postComment, $createdPostComment);
    }

    /**
     * @test read
     */
    public function testReadPostComment()
    {
        $postComment = $this->makePostComment();
        $dbPostComment = $this->postCommentRepo->find($postComment->id);
        $dbPostComment = $dbPostComment->toArray();
        $this->assertModelData($postComment->toArray(), $dbPostComment);
    }

    /**
     * @test update
     */
    public function testUpdatePostComment()
    {
        $postComment = $this->makePostComment();
        $fakePostComment = $this->fakePostCommentData();
        $updatedPostComment = $this->postCommentRepo->update($fakePostComment, $postComment->id);
        $this->assertModelData($fakePostComment, $updatedPostComment->toArray());
        $dbPostComment = $this->postCommentRepo->find($postComment->id);
        $this->assertModelData($fakePostComment, $dbPostComment->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePostComment()
    {
        $postComment = $this->makePostComment();
        $resp = $this->postCommentRepo->delete($postComment->id);
        $this->assertTrue($resp);
        $this->assertNull(PostComment::find($postComment->id), 'PostComment should not exist in DB');
    }
}
